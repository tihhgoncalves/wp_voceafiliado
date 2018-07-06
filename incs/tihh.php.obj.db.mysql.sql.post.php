<?

/**
 * Objeto de PHP que gera SQL (post) automaticamente.
 *
 * versуo: 1.0
 *
 */
class tihh_db_mysql_sql_post{

  private $fields = array();
  private $table;

  public $id = -1;

  public function __construct($table){
    $this->table = $table;
  }

  public function AddFieldString($fieldName, $value){

    if($value == null)
      $value = 'NULL';
    else
      $value = "'$value'";

    $this->fields[$fieldName] = $value;
  }

  public function AddFieldNumber($fieldName, $value){

    if($value == null)
      $value = "NULL";

    $this->fields[$fieldName] = $value;

  }

  public function AddFieldInteger($fieldName, $value){
    $value = intval($value);
    $this->fields[$fieldName] = $value;
  }

  public function AddFieldBoolean($fieldName, $value){
    $value = ($value)?"'Y'":"'N'";
    $this->fields[$fieldName] = $value;
  }

  public function AddFieldDateTime($fieldName, $value){
    $this->fields[$fieldName] = $value;
  }

  public function AddFieldDateTimeNow($fieldName){
    $value = "NOW()";
    $this->fields[$fieldName] = $value;
  }

  public function AddFieldDateToday($fieldName){
    $value = "TODAY()";
    $this->fields[$fieldName] = $value;
  }

  public function GetSQL(){

    if(count($this->fields) == 0){
      die('[tihh_db_mysql_sql_post] Vocъ nуo pode gerar o SQl sem nenhum campo setado.');
    }

    //Inserчуo ou Atualizaчуo..
    if($this->id > 0){

      $sql   = 'UPDATE `' . $this->table . '` SET ';

      $sql_fields = array();

      foreach ($this->fields as $x=>$field) {
        $sql_fields[] = '`' . $x . '` = ' . $field;
      }

      $sql .= implode(', ', $sql_fields);

      $sql .= ' WHERE ID = ' . $this->id;

    } else {

      $sql  = 'INSERT INTO ' . $this->table;

      $sql_fields = array();
      $sql_values = array();

      foreach ($this->fields as $x=>$field) {
        $sql_fields[]  = '`' . $x . '`';
        $sql_values[] = $field;
      }

      $sql .= '(' . implode(', ', $sql_fields) . ')';
      $sql .= ' VALUES(' . implode(', ', $sql_values) . ')';
    }

    return $sql;
  }

}
?>