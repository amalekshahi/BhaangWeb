<?php
/**
 * Survey Class.
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @see SurveyQuestion, SurveyAnswer
 * @version 1.0
 */
class Survey
{
    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Returns if the survey was completed or not.
     * @return bool true if complete
     */
    public function isComplete() {
        return $this->_isComplete;
    }

    /**
     * Returns the date and time when the survey was saved.
     * @return DateTime saved on date and time
     */
    public function getDateTime() {
        return $this->_dateTime;
    }

    /**
     * Returns the number of questions in the survey.
     * @return int number of questions
     */
    public function countQuestions() {
        return $this->_qa->count();
    }

    /**
     * Returns the question at the specified index.
     * @param int $index specified index
     * @return SurveyQuestion question at index
     */
    public function getQuestionAt($index) {
        return $this->_qa->offsetGet((int)$index);
    }

    /**
     * Returns a question by its Id.
     * @param int $id specified id
     * @return SurveyQuestion or null
     */
    public function getQuestionById($id)
    {
        $i = $this->_qa->getIterator();
        while( $i->valid() ){
            if( $i->current()->getId() == (int)$id )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns a question by its number.
     * @param int $number
     * @return SurveyQuestion or null
     */
    public function getQuestionByNo($number)
    {
        $i = $this->_qa->getIterator();
        while( $i->valid() ){
            if( $i->current()->getNo() == (int)$number )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns a question by its label.
     * @param string $label
     * @return SurveyQuestion or null
     */
    public function getQuestionByLabel($label)
    {
        $i = $this->_qa->getIterator();
        while( $i->valid() ){
            if( strtolower($i->current()->getLabel()) == strtolower($label) )
                return $i->current();
            $i->next();
        }
        return null;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Method

    private $_isComplete;
    private $_dateTime;
    /**
     * @var ArrayObject
     */
    private $_qa;

    /**
     * Create a new Survey object.
     * <b>INTERNAL CONSTRUCTOR.
     * Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param String $surveyArray
     * @internal
     */
    public function  __construct($surveyArray)
    {
        $this->_isComplete = @$surveyArray['surveySaveDate'] != '0000-00-00 00:00:00';
        $this->_dateTime = new DateTime(@$surveyArray['surveySaveDate']);
        $this->_qa = new ArrayObject();

        $lastId = -1;
        $answers = array();
        
        //foreach( @$surveyArray['answer'] as $qa )
        for( $i = 0 ; $i <= count(@$surveyArray['answer']) ; $i++ )
        {
            $qa = @$surveyArray['answer'][$i];
            if( $lastId > -1 && $lastId != @$qa['question']['questionID'] ){    
                $this->_qa->append( new SurveyQuestion($id, $no, $text, $label, $answers) );
                $answers = array();
            }
            
            if( !is_array($qa) )
                return;
            
            $id = @$qa['question']['questionID'];
            $no = @$qa['question']['questionNo'];
            $text = @$qa['question']['questionText'];
            $label = @$qa['question']['questionLabel'];
            $lastId = @$id;
            
            $aId = (int)@$qa['answerID'];
            if( $aId > -1 )
                $answers[] = new SurveyAnswer($aId, @$qa['answerNo'], @$qa['answerChoice'], @$qa['answerLabel']);
        }
    }
}

/**
 * Survey Question Class.
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @see Survey, SurveyAnswer
 * @version 1.0
 */
class SurveyQuestion
{
    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Returns the question Id.
     * @return int id id of the question
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Returns the question number.
     * @return int number of the question
     */
    public function getNo() {
        return $this->_number;
    }

    /**
     * Returns the text of the question.
     * @return string text of the question
     */
    public function getText() {
        return $this->_text;
    }

    /**
     * Returns the label of the question.
     * @return string label of the question
     */
    public function getLabel() {
        return $this->_label;
    }

    /**
     * Returns if the question was answered or not.
     * @return bool true if answered
     */
    public function isAnswered() {
        return (bool)$this->_answers->count();
    }

    /**
     * Returns the number of answers.
     * Checkbox questions can have multiple answers.
     * @return int number of answers
     */
    public function countAnswers() {
        return $this->_answers->count();
    }

    /**
     * Returns the answer to single-choice questions.
     * This method calls Survey->getAnswerAt(0).
     * @return SurveyAnswer answer to question
     */
    public function getAnswer() {
        return $this->getAnswerAt(0);
    }

    /**
     * Returns the answer at the specified index.
     * @param int $index specified index
     * @return SurveyAnswer answer at index
     */
    public function getAnswerAt($index) {
        return $this->_answers->offsetGet((int)$index);
    }

    /**
     * Returns the answer by its Id.
     * @param int $id specified id
     * @return SurveyAnswer answer by id
     */
    public function getAnswerById($id)
    {
        $i = $this->_answers->getIterator();
        while( $i->valid() ){
            if( $i->current()->getId() == (int)$id )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns the answer by its number.
     * @param int $id specified number
     * @return SurveyAnswer answer by number
     */
    public function getAnswerByNo($number)
    {
        $i = $this->_answers->getIterator();
        while( $i->valid() ){
            if( $i->current()->getNo() == (int)$number )
                return $i->current();
            $i->next();
        }
        return null;
    }

    /**
     * Returns the answer by its label.
     * @param int $id specified label
     * @return SurveyAnswer answer by label
     */
    public function getAnswerByLabel($label)
    {
        $i = $this->_answers->getIterator();
        while( $i->valid() ){
            if( strtolower($i->current()->getLabel()) == strtolower($label) )
                return $i->current();
            $i->next();
        }
        return null;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Method

    private $_id;
    private $_number;
    private $_text;
    private $_label;
    /**
     * @var ArrayObject
     */
    private $_answers;

    /**
     * Create a new SurveyQuestion object.
     * <b>INTERNAL CONSTRUCTOR.
     * Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param int $id
     * @param int $number
     * @param string $text
     * @param string $label
     * @param array $answers
     * @internal
     */
    public function  __construct($id, $number, $text, $label, $answers)
    {
        $this->_id = (int)$id;
        $this->_number = (int)$number;
        $this->_text = $text;
        $this->_label = $label;
        $this->_answers = new ArrayObject($answers);
    }
}

/**
 * SurveyAnswer Class.
 *
 * @author Patrick Martin <pmartin@mindfireinc.com>
 * @see Survey, SurveyQuestion
 * @version 1.0
 */
class SurveyAnswer
{
    ////////////////////////////////////////////////////////////////////////////
    // PUBLIC INTERFACE

    /**
     * Returns id of the answer.
     * @return int id of answer
     */
    public function getId() {
        return $this->_id;
    }

    /**
     * Returns number of the answer.
     * @return int number of answer
     */
    public function getNo() {
        return $this->_number;
    }

    /**
     * Returns the choice to the answer.
     * @return string choice to the answer
     */
    public function getChoice() {
        return $this->_choice;
    }

    /**
     * Returns the label of the answer.
     * @return string label of answer
     */
    public function getLabel() {
        return $this->_label;
    }

    ////////////////////////////////////////////////////////////////////////////
    // Private Method

    private $_id;
    private $_number;
    private $_choice;
    private $_label;

    /**
     * Create a new SurveyAnswer object.
     * <b>INTERNAL CONSTRUCTOR.
     * Using this Constructor will break your code on future releases.
     * This Contructor is not future-safe and is only to be used by the package.
     * In PHP 5.3+, it will be changed to package visible.</b>
     * @param int $id
     * @param String $name
     * @internal
     */
    public function  __construct($id, $number, $choice, $label)
    {
        $this->_id = (int)$id;
        $this->_number = (int)$number;
        $this->_choice = $choice;
        $this->_label = $label;
    }
}
