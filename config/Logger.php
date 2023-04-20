<?php
class Logger
{

    private $logFile;
    public function __construct()
    {
        $logFilePath = 'storage/logs/error_log.txt';
        $this->logFile = realpath(__DIR__ . '/../' . $logFilePath);
    }
    public function logException($exception)
    {
        $logFile = $_SERVER['DOCUMENT_ROOT'] . "/storage/logs/error_log.txt";
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $message = $exception->getMessage();
        $fileName = $exception->getFile();
        $line = $exception->getLine();
        $logMessage = date('Y-m-d H:i:s') . ", $ipAddress, $browser, $message, $fileName, $line\n";
        error_log($logMessage, 3, $this->logFile);
    }
}
