<?php
defined('SYSPATH') or die('No direct script access.');

class Model_User extends Model
{

	/**
	 * метод авторизует пользователя
	 *
	 * @param $login
	 * @param $pass
	 *
	 * @return bool|mixed
	 */
	public function auth($login, $pass)
	{
		$user = false;
		if ($login != '' && $pass != '') {
			$pass = md5(md5($pass));
			$sql = $this->_pdo->prepare("SELECT id, login, balance FROM users WHERE login = ? and pass = ? LIMIT 1");
			if ($sql->execute(array($login, $pass))) {
				$user = $sql->fetch();
				if ($user) {
					$id = $user['id'];
					//авторизуем пользователя
					$hash = $this->generateCode(32);
					$sql = $this->_pdo->prepare("UPDATE users SET hash = ? where id = ?");
					if ($sql->execute(array($hash, $id))) {
						// Ставим куки
						setcookie("id", $id, time() + 60 * 60 * 24 * 30);
						setcookie("hash", $hash, time() + 60 * 60 * 24 * 30);
					}
				}
			}
		}
		//
		return $user;
	}

	/**
	 * Списание денег у клиента
	 * @return bool
	 */
	public function withdraw($amount=0)
	{
		$id = $_COOKIE['id'];
		$balance = $this->getBalanceById($id);

		$logger = new \Liberta\MLogger\Logger(LOGS_PATH);
		$logger->info('withdraw', ['transaction_start.user_id='.$id.', balance='.$balance]);
		$logger->info('withdraw', ['amount='.$amount]);

		if ($balance > 0 and $amount <= $balance and $amount > 0) {
			try {
				$this->_pdo->beginTransaction();
				$sql = $this->_pdo->prepare("UPDATE users SET balance = balance - ? where id = ?");
				$sql->execute(array($amount, $id));
				$this->_pdo->commit();
				$logger->info('withdraw', ['transaction_commit.user_id='.$id]);
				return true;
			} catch (Exception $e) {
				$this->_pdo->rollBack();
				$logger->error('withdraw', ['transaction_rollback.user_id='.$id]);
				$logger->error('withdraw', [$e->getMessage()]);
				return false;
			}
		} else {
			$logger->error('withdraw', ['transaction_stop.user_id='.$id.', недостаточно средств для списания']);
		}
		//
		return false;
	}

	/**
	 * Проверка авторизации
	 *
	 * @return bool
	 */
	public function is_auth()
	{
		if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
			$sql = $this->_pdo->prepare("SELECT id, login, balance FROM users WHERE id = ? and hash = ? LIMIT 1");
			if ($sql->execute(array($_COOKIE['id'], $_COOKIE['hash']))) {
				$user = $sql->fetch();
				if ($user) {
					return $user;
				}
			}
		}
		//
		return false;
	}

	/**
	 * генерация случайного хеша
	 *
	 * @param int $length
	 *
	 * @return string
	 */
	private function generateCode($length = 6)
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0, $clen)];
		}

		return $code;
	}

	/**
	 * Получение баланса по id пользователя
	 * @param $id
	 *
	 * @return bool
	 */
	private function getBalanceById($id)
	{
		$sql = $this->_pdo->prepare("SELECT balance FROM users WHERE id = ?");
		if ($sql->execute(array($id))) {
			$user = $sql->fetch();
			if ($user) {
				return $user['balance'];
			}
		}
		//
		return false;
	}
}