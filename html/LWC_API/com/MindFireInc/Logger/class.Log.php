<?php
/**
 * Class to Log Messages.
 *
 * By default, this class saves Error and Fatal messages to '/LWC_API/logs/'.
 * It is recommended that you set your own logs directory with Log::logDirPath().
 * <p>
 * Log Level Order: Message, Warning, Error, Fatal.
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @package com_MindFireInc_Logger
 * @version 1.0
 */
class Log
{
    static private $_isActive = true;
    static private $_minLevel = 200;
    static private $_logDirPath = '';

    ////////////////////////////////////////////////////////////////////////////
    // STATIC PUBLIC INTERFACE

    const LEVEL_MESSAGE = 0;
    const LEVEL_WARNING = 100;
    const LEVEL_ERROR = 200;
    const LEVEL_FATAL = 300;

    /**
     * Outputs a message flagged as Message.
     * @param string $message log message
     * @param bool $printStackTrace include stack trace in output
     */
    static public function Msg($message, $printStackTrace = false)
    {
        $log = new Log($message, self::LEVEL_MESSAGE);
        $log->_printTraceStack = (bool)$printStackTrace;
        $log->saveToFile();
    }

    /**
     * Outputs a message flagged as Warning.
     * @param string $message log message
     * @param bool $printStackTrace include stack trace in output
     */
    static public function Warning($message, $printStackTrace = false)
    {
        $log = new Log($message, self::LEVEL_WARNING);
        $log->_printTraceStack = (bool)$printStackTrace;
        $log->saveToFile();
    }

    /**
     * Outputs a message flagged as Error with a trace stack.
     * @param string $message log message
     * @param bool $printStackTrace include stack trace in output
     */
    static public function Error($message, $printStackTrace = true)
    {
        $log = new Log($message, self::LEVEL_ERROR);
        $log->_printTraceStack = (bool)$printStackTrace;
        $log->saveToFile();
    }

    /**
     * Outputs a message flagged as FATAL with a trace stack.
     * @param string $message log message
     * @param bool $printStackTrace include stack trace in output
     */
    static public function Fatal($message, $printStackTrace = true)
    {
        $log = new Log($message, self::LEVEL_FATAL);
        $log->_printTraceStack = (bool)$printStackTrace;
        $log->saveToFile();
    }

    /**
     * Sets if logging output is to be saved.
     * @param bool $isActive true to save output
     */
    static public function active($isActive = false)
    {
        self::$_isActive = $isActive;
    }

    /**
     * Sets logging level.  Outputs specified level and above.
     * <p>
     * Log Level Order: Message, Warning, Error, Fatal.
     * 
     * @param int $LOG_LEVEL_CONST log level constant
     */
    static public function loggingLevel($LOG_LEVEL_CONST = LEVEL_FATAL)
    {
        self::$_minLevel = $LOG_LEVEL_CONST;
    }

    /**
     * Set the directory path of the log file.
     * @param string $path '/foo/bar/app_dir/logs/'
     */
    static public function logDirPath($path)
    {
        self::$_logDirPath = (string)$path;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Methods

    private $_dateTime;
    private $_level;
    private $_message;
    private $_filePath;
    private $_printTraceStack;

    private function __construct($message, $level)
    {
        $this->_dateTime = new DateTime();
        $this->_level = (int)$level;
        $this->_message = (string)$message;
        $this->_filePath = @$_SERVER['SCRIPT_FILENAME'];
        $this->_printTraceStack = false;
    }

    private function saveToFile()
    {
        if( !self::$_isActive || self::$_minLevel > $this->_level )
            return;
        
        if( self::$_logDirPath == '' )
            self::$_logDirPath = realpath(dirname(__FILE__).'/../../../logs/');

        file_put_contents(self::$_logDirPath.$this->_dateTime->format('Y-m-d').'.log', $this->toString(), FILE_APPEND);
    }
    
    private function toString()
    {
        if( self::$_minLevel >= self::LEVEL_FATAL)
            $output = '[ FATAL ]';
        else if( self::$_minLevel >= self::LEVEL_ERROR )
            $output = '[ ERROR ]';
        else if(self::$_minLevel >= self::LEVEL_WARNING )
            $output = '[WARNING]';
        else
            $output = '[MESSAGE]';

        $output .= $this->_dateTime->format('[H:i d M y] ');
        $output .= $this->_message."\r\n";

        if( $this->_printTraceStack ){
            $debug = debug_backtrace();
            for( $i = 2 ; $i < count($debug) ; $i++ ){
                $d = $debug[$i];
                $output .= "                           - Line {$d['line']}: {$d['class']}{$d['type']}{$d['function']} in {$d['file']}";
                $output .= "\r\n";
            }
        }

        return $output;
    }

}

