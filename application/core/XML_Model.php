<?php

class XML_Model extends Memory_Model
{
//---------------------------------------------------------------------------
//  Housekeeping methods
//---------------------------------------------------------------------------
    protected $_xml;
	/**
	 * Constructor.
	 * @param string $origin Filename of the xml file
	 * @param string $keyfield  Name of the primary key field
	 * @param string $entity	Entity name meaningful to the persistence
	 */
	function __construct()
	{
        $this->_xml = simplexml_load_file('../data/tasks.xml');
        $this->_data = array(); // an array of objects
        $this->_fields = array(); // an array of strings
        $this->_keyfield = 'id';
		$this->load();
	}

	/**
	 * Load the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function load()
	{
        $data = $this->_xml;
        $allTasks;
        $first = true;
        foreach ($this->_xml as $task)
        {
            if($first)
            {
                foreach($task as $attribute)
                {
                    array_push($this->_fields, $attribute->getName());
                }
                $first = false;
            }
            $record = new stdClass();
            for($i = 0; $i< count($this->_fields); $i++)
            {
                $record->{$this->_fields[$i]} = (string)$task->{$this->_fields[$i]};
            }
            $key = $record->{$this->_keyfield};
            $this->_data[$key] = $record;
        }
		// --------------------
		// rebuild the keys table
		$this->reindex();
	}

	/**
	 * Store the collection state appropriately, depending on persistence choice.
	 * OVER-RIDE THIS METHOD in persistence choice implementations
	 */
	protected function store()
	{
		// rebuild the keys table
		$this->reindex();
		//---------------------
		if (($handle = fopen($this->_origin, "w")) !== FALSE)
		{
			fputcsv($handle, $this->_fields);
			foreach ($this->_data as $key => $record)
				fputcsv($handle, array_values((array) $record));
			fclose($handle);
		}
		// --------------------
	}

}
