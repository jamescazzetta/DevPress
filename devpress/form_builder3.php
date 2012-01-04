<?php
	function data($a,$b,$c){
		return array("name" => "examplevalue", "firstname" => "examplevalue2", "NewTarget" => array(1 => array('somename' => 'somevalue')), "");
	}
	function TweenTable($OriginTable, $TargetTable){
		$tables = array($OriginTable, $TargetTable);
		sort($tables);  //sort alphabeticaly to prevent bla2bla confusions
		return $tables[0].'2'.$tables[1];
	}
	
	//Sets up the form
	class Form{
		public function __construct($origintable = "NoOriginTable", $originid = 0){
			$this->OriginTable = $origintable;
			$this->TargetTable = $this->OriginTable;
			$this->OriginID	= $originid;
			$this->ButtonLabels	= array("submit" => "Save", "cancel" => "Cancel", "delete" => FALSE, "publish" => FALSE);
			$this->SQLOrigindata = data(array($this->OriginTable), array($this->OriginID), 1);
			echo '<form  method="post" class="editarea" action="?action=save&edit_id=' . $this->OriginID .'"><input type="hidden" name="id" value="' . $this->OriginID  . '">';
		}
		public function __destruct() { 
			$return = '<p>';
			$return .= '<span class="button-group">';
				$return .= (array_key_exists('submit',$this->ButtonLabels) && $this->ButtonLabels['submit'] ? $this->GetSubmitButton($this->ButtonLabels['submit']) : "");
				$return .= (array_key_exists('cancel',$this->ButtonLabels) && $this->ButtonLabels['cancel'] ? $this->GetCancelButton($this->ButtonLabels['cancel']) : "");
			$return .= '</span>';
			$return .= '</p></form>';

			echo $return;
		}
		
		public function setButtonLabels($args){
			$this->ButtonLabels = $args;
		}
		
		public function getSubmitButton($label){
			return "<input type='submit' name='submit' value='$label' class='button primary submit icon approve'>";
		}
		
		public function getCancelButton($label){
			return "<a href='".$_SERVER['SCRIPT_NAME']."' class='button'>$label</a>";
		}
		
	}
	
	//creates form element-groups (with a common origin/target pattern)
	class FormMultigroup {
		public function __construct($form = "", $targettable = "NoTargetTable"){
			echo "<section>";
			
			if (empty($form)) {$form = new Form;}
			
			$this->OriginTable = $form->OriginTable;
			$this->OriginID	= $form->OriginID;
			$this->TargetTable = $targettable;
			$this->TweenTable = TweenTable($this->OriginTable, $this->TargetTable);
			$this->SQLTargetdata = data(array($this->OriginTable), array($this->OriginID), 1);
			$this->SQLOrigindata = $form->SQLOrigindata;
			
			//gett all matching target ids
			$this->TargetIDs = array();
			if (array_key_exists($this->TargetTable,$this->SQLOrigindata)) {		
				foreach ($this->SQLOrigindata[$this->TargetTable] as $id => $value) {
					$this->TargetIDs[] = $id; 
				}
			}
			
			//when plus or minus button has been pressed add/remove connection
			if (array_key_exists($this->TargetTable, $_POST)) {
				switch ($_POST[$this->TargetTable]) {
					case '+':
						$into = '';
						foreach ($args['target_cols'] as $key => $value) {
							$into .= $key.',';
						}
						$values = str_repeat(" NULL, ", count($args['target_cols']));
						//Create new entree in target Table
						$sql = "INSERT INTO $this->TargetTable VALUES (default)";
						$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);
						
						$this->TargetID = mysql_insert_id();
						//Create new entree into tween Table
						$sql = "INSERT INTO $this->TweenTable ({$this->TargetTable}_id, {$this->OriginTable}_id)
								VALUES ($this->TargetID, $this->OriginID)";
						$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);

						//redoo data
						$this->SQLOrigindata = data(array($this->OriginTable), array($this->OriginID), 1);					
					break;

					case '-':
						//remove from tween (Data remains on the Target table!!!)
						$sql = "DELETE FROM $this->TweenTable WHERE id = $_POST[multigroup_remove] ";
						$result = mysql_query($sql) or trigger_error("SQL", E_USER_ERROR);

						//redoo data
						$this->SQLOrigindata = data(array($this->OriginTable), array($this->OriginID), 1);					
					break;
					
				}

			}
		
		}
		
		public function __destruct(){
			echo "</section>";
		}
	}
	

	
	//creates form elements
	class FormElement {
		public function __construct($parent = "", $col = "NoCol", $title = "", $description = ""){
			if (empty($parent)) {
				$parent = new Form;
				$parent->setButtonLabels(array());
			}
			$this->parent 				= $parent;
			$this->OriginCol			= "OriginColIsRequired";
			$this->TargetID				= $parent->OriginID;
			$this->SQLTargetdata		= $parent->SQLOrigindata;
			$this->TargetTable			= $parent->TargetTable;
			$this->TargetCol			= $col;
			$this->PostName				= $this->TargetTable . ':' . $this->TargetCol . '::' .  $this->TargetID;
			$this->ElementTitle			= ($title ? $title : $this->TargetCol );
			$this->ElementDescription 	= $description;
			$this->InputType			= "text";
	
			//save data
			if ($this->isDataOld()) {
				$this->SaveData();
			}
			$this->SQLTargetdata = data(array($this->TargetTable), array($this->TargetID), 1);
		}
		public function __destruct() { 
		}
		//default return if obj is echoed without method
		public function __toString(){
			return $this->getElement();
		}
		
		private function isDataOld(){
			$isold = FALSE;
			if (array_key_exists($this->PostName,$_POST)) {
				if ($this->SQLTargetData[$this->Targetcol] != $_POST[$this->PostName]) {
					$isold = TRUE;
				}
			}
			return $isold;
		}
		
		private function SaveData(){
			switch ($this->InputType) {
				case 'text':
					$where = " AND id = " . $this->TargetID ;
					$sql =	"UPDATE {$GLOBALS['tableprefix']}_{$this->TargetTable}
							SET ".$this->TargetCol." = '".$_POST[$this->PostName]."' 
							WHERE 0=0 $where";
					mysql_query($sql);
				break;
				
				default:
				break;
			}
		}

		public function setInputType($typestring){
				$this->type = $typestring;
		}
		

		public function getElement(){
			$return = "<section>";
				switch ($this->InputType) {
					case 'text':
						$return .= "<label for='".$this->PostName."'>".$this->ElementTitle."<small>".$this->ElementDescription."</small></label>";
						$return .= "<div>" . $this->getInputTextfield() . "</div>";
				}
			
			return $return. "</section>";
		}
		
		public function getMultigroupElements(){
			$this->TargetIDs = $this->parent->TargetIDs; 
			
			$return = '';
			if (count($this->TargetIDs)) {
				foreach ($this->TargetIDs as $id) {
					$return .= $this->getElement();
				}
			}

			return $return;
		}
		
		public function getInputTextfield(){
			$value = (array_key_exists($this->TargetCol,$this->SQLTargetdata) ? $this->SQLTargetdata[$this->TargetCol] : "column:[" . "$this->TargetCol" . "] Can not be found.");
			return "<input id=".$this->PostName." type='".$this->InputType."' name='".$this->PostName."' value='".$value."'>";
		}
	
	}


	
		
	$form = new Form('Menschen', 4);
	$form->setButtonLabels(array("submit" => "Save", "cancel" => "Cancel", "delete" => FALSE, "publish" => FALSE));
		$element = new FormElement($form, "name", "Lastname", "Enter your family-name here please.");
			$element->setInputType("text");
			echo $element->getElement();
		unset($element);
		
		$element = new FormElement($form, 'firstname', 'Firstname', "Enter your first-name here please.");
			$element->setInputType("text");
			echo $element->getElement();
		unset($element);
		
		$multigroup = new FormMultigroup($form, 'NewTarget');
			$multigroupitem = new FormElement($multigroup, 'somename', 'MultigroupElement');
				$multigroupitem->setInputType("text");
				echo $multigroupitem->getMultigroupElements();
				
			unset($multigroupitem);
		unset($multigroup);
		
		
		/*
		$element = new FormElement($form);
			$element->setTargetTable("numbersandletters");
			$element->setInputType('text', 'text', 'text');
			$element->setTargetCol(array('123', '456', '789'));
			$element->setElementTitle(array('abc', 'def', 'ghi'));
			$element->setElementDescription(array("Enter your letters here please.", "Enters a numbers", "Optional"));
			echo $element->getElement();
		unset($element);
	*/
	unset($form);
	
	
	
?>