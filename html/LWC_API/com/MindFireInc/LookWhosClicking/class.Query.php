<?php
/**
 * Create queries to interface with the LWC Web Service.
 *
 * <b>Code example demonstrating how to use the Query class.</b>
 * <code>
 * $query1 = Query::Build()->andId(100)->andUrl('johnsample');
 * echo "<p>Query1: {$query1->toString()}</p>";
 * // outupts: Query1: userID = 100 AND url = 'johnsample'
 *
 * $query2 = Query::Build()->andId(200)->andUrl('marysample');
 * echo "<p>Query1: {$query2->toString()}</p>";
 * // outupts: Query2: userID = 200 AND url = 'marysample'
 *
 * $query3 = Query::Build()->QueryOrQuery($query1, $query2);
 * echo "<p>Query3: {$query3->toString()}</p>";
 * // outupts: Query3: ( userID = 100 AND url = 'johnsample' ) OR ( userID = 200 AND url = 'marysample' )
 * </code>
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @version 1.0
 */
class Query
{
    ////////////////////////////////////////////////////////////////////////////
    // STATIC INTERFACE

    /**
     * Instantiates a Query object to start building a query.
     * @return Query
     */
    static function Build()
    {
        return new Query();
    }

    /**
     * Instantiates a Query object to return/affect all records.
     * @return Query
     */
    static function All()
    {
        $query = new Query();
        $query->_query = '    1';
        return $query;
    }

    /**
     * Combines two queries with the AND operator.
     * @param Query $query1 a query
     * @param Query $query2 another query
     * @return Query new Query
     */
    static public function QueryAndQuery(Query $query1, Query $query2)
    {
        $newQuery = new Query();
        $newQuery->_query = ' AND ('. $query1->toString() .') AND ('. $query2->toString() .') ';
        return $newQuery;
    }

    /**
     * Combines two queries with the OR operator.
     * @param Query $query1 a query
     * @param Query $query2 another query
     * @return Query new query
     */
    public function QueryOrQuery(Query $query1, Query $query2)
    {
        $newQuery = new Query();
        $newQuery->_query = ' AND ('. $query1->toString() .') OR ('. $query2->toString() .') ';
        return $newQuery;
    }
    
    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Add an Id with AND.
     * @param int $val id of prospect
     * @return Query this query
     */
    public function andId($val)
    {
        $val = (int)$val;
        $this->_query .= " AND ".ProspectProps::ID." = $val ";
        return $this;
    }

    /**
     * Add an Id with OR.
     * @param int $val id of prospect
     * @return Query this query
     */
    public function orId($val)
    {
        $val = (int)$val;
        $this->_query .= "  OR ".ProspectProps::ID." = $val ";
        return $this;
    }

    /**
     * Add an Url with AND.
     * @param string $val url of prospect
     * @return Query this query
     */
    public function andUrl($val)
    {
        $val = $this->escape(ProspectProps::Validate(ProspectProps::URL, $val));
        $this->_query .= " AND ".ProspectProps::URL." = '$val' ";
        return $this;
    }

    /**
     * Add a Url with OR.
     * @param string $val url of prospect
     * @return Query this query
     */
    public function orUrl($val)
    {
        $val = $this->escape(ProspectProps::Validate(ProspectProps::URL, $val));
        $this->_query .= "  OR ".ProspectProps::URL." = '$val' ";
        return $this;
    }

    /**
     * Add an updated by prospect flag with AND.
     * @param bool $isUpdated true for updated
     * @return Query this query
     */
    public function andUpdated($isUpdated = true)
    {
        $flag = (bool)$isUpdated ? 'TRUE' : 'FALSE';
        $this->_query .= " AND updateFlag = '{$flag}' ";
        return $this;
    }

    /**
     * Add an updated by prospect flag with OR.
     * @param bool $isUpdated true for updated
     * @return Query this query
     */
    public function orUpdated($isUpdated = true)
    {
        $flag = (bool)$isUpdated ? 'TRUE' : 'FALSE';
        $this->_query .= "  OR updateFlag = '{$flag}' ";
        return $this;
    }

    /**
     * Add a visited by prospect flag with AND.
     * @param bool $hasVisited true for visited
     * @return Query this query
     */
    public function andVisited($hasVisited = true)
    {
        if( $hasVisited )
            $this->_query .= " AND numOfVisit > 0 ";
        else
            $this->_query .= " AND numOfVisit = 0 ";
        return $this;
    }

    /**
     * Add a visited by prospect flag with OR.
     * @param bool $hasVisited true for visited
     * @return Query this query
     */
    public function orVisited($hasVisited = true)
    {
        if( $hasVisited )
            $this->_query .= "  OR numOfVisit > 0 ";
        else
            $this->_query .= "  OR numOfVisit = 0 ";
        return $this;
    }

    /**
     * Add a mail list with AND.
     * @param MailList $list a mail list
     * @return Query this query
     */
    public function andMailList(MailList $list)
    {
        $this->_query .= " AND listId = {$list->getId()} ";
        return $this;
    }

    /**
     * Add a mail list with OR.
     * @param MailList $list a mail list
     * @return Query this query
     */
    public function orMailList(MailList $list)
    {
        $this->_query .= "  OR listId = {$list->getId()} ";
        return $this;
    }

    /**
     * Add a ProspectProp with AND.
     * @param string $PROSPECT_PROPS a ProspectProp property
     * @param mixed $val property value
     * @return Query this query
     */
    public function andProp($PROSPECT_PROPS, $val)
    {
        $val = $this->escape( ProspectProps::Validate($PROSPECT_PROPS, $val) );
        $this->_query .= " AND $PROSPECT_PROPS = '$val' ";
        return $this;
    }

    /**
     * Add a ProspectProp with OR.
     * @param string $PROSPECT_PROPS a ProspectProp property
     * @param mixed $val property value
     * @return Query this query
     */
    public function orProp($PROSPECT_PROPS, $val)
    {
        $val = $this->escape( ProspectProps::Validate($PROSPECT_PROPS, $val) );
        $val = $this->escape($val);
        $this->_query .= "  OR $PROSPECT_PROPS = '$val' ";
        return $this;
    }

    ////////////////////////////////////////////////////////////////////////////

    /**
     * Returns the query as an SQL where clause.
     * @return string SQL WHERE clause
     */
    public function toString() {
        return substr($this->_query, 4);
    }

    /**
     * Creates a copy of this query.
     * @return Query copy of this instance
     */
    public function copy()
    {
        $copy = new Query();
        $copy->_query = $this->_query;
        return $copy;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Methods

    private $_query;

    private function  __construct()
    {
        $this->_query = '';
    }

    private function escape($str)
    {
        $search=array("\\","\0","\n","\r","\x1a","'",'"');
        $replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
        return str_replace($search,$replace,(string)$str);
    }
}

