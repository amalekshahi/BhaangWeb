<?php
/**
 * Collection of ActivityHit objects.
 * This class tracks the visit activity of Prospects.
 * 
 * @author Patrick Martin <pmartin@mindfireinc.com>
 */
class Activity
{
    const PAGE_WELCOME = 'welcome';
    const PAGE_SURVEY = 'survey';
    const PAGE_SURVEY_COMPLETE = 'surveyComplete';
    const PAGE_PROFILE_CONFIRM = 'confirm';
    const PAGE_THANK_YOU = 'thanks';
    
    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Returns the number of pages hit.
     * @return int number of ActivityHits
     */
    public function count() {
        return $this->_hits->count();
    }

    /**
     * Returns the ActivityHit object at specified index.
     * @param int $index specified index
     * @return ActivityHit
     */
    public function getAt($index) {
        return $this->_hits->offsetGet((int)$index);
    }

    /**
     * Returns an array copy of ActivityHit objects.
     * @return array an array of ActivityHit objects
     */
    public function getArrayCopy() {
        return $this->_hits->getArrayCopy();
    }

    /**
     * Returns the ActivityHit object by specified page, or null if no visit.
     * @param string $PAGE_CONST specified page
     * @return ActivityHit or null
     */
    public function getHitByPage($PAGE_CONST)
    {
        foreach( $this->_hits->getArrayCopy() as $hit )
            if( $hit->getPageVisited() == (string)$PAGE_CONST )
                return $hit;
        return null;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Methods

    private $_hits;

    /**
     * Internal Constructor.
     * <b>Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param array $activityArray
     * @internal
     */
    public function __construct($activityArray)
    {
        $this->_hits = new ArrayObject();
        if( is_array($activityArray) )
            foreach( $activityArray as $hit )
                $this->_hits->append(
                        new ActivityHit(
                                @$hit['pageVisited'],
                                new DateTime(@$hit['accessTime']),
                                @$hit['urlVisited'],
                                @$hit['ipAddress'],
                                @$hit['userAgent']
                        )
                );
    }

}

/**
 * ActivityHit Class.
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @see Activity
 */
class ActivityHit
{
    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Returns the name of the page visited.
     * @return string Acvitity::PAGE_CONST
     */
    public function getPageVisited() {
        return $this->_pageVisited;
    }

    /**
     * Returns the date and time of the visit.
     * @return DateTime visit date and time
     */
    public function getDateTime() {
        return $this->_dateTime;
    }

    /**
     * Returns the visitor's PURL.
     * @return string purl without http://
     */
    public function getUrlVisited() {
        return $this->_urlVisited;
    }

    /**
     * Returns the IP Address of the visitor.
     * @return string IP address
     */
    public function getIpAddress() {
        return $this->_ipAddress;
    }

    /**
     * Returns the user agent identification.
     * @return string user agent data
     */
    public function getUserAgent() {
        return $this->_userAgent;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Methods

    private $_pageVisited;
    private $_dateTime;
    private $_urlVisited;
    private $_ipAddress;
    private $_userAgent;

    /**
     * Internal Constructor.
     * <b>Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param string $ACTIVITY_PAGE_CONST
     * @param DateTime $dateTime
     * @param string $urlVisited
     * @param string $ipAddress
     * @param string $userAgent
     * @internal
     */
    public function  __construct($ACTIVITY_PAGE_CONST, DateTime $dateTime, $urlVisited, $ipAddress, $userAgent)
    {
        $this->_pageVisited = $ACTIVITY_PAGE_CONST;
        $this->_dateTime = $dateTime;
        $this->_urlVisited = $urlVisited;
        $this->_ipAddress = $ipAddress;
        $this->_userAgent = $userAgent;
    }

}

