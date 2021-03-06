<?
class Collection extends AppModel {
  public $name = 'Collection';
  public $hasMany = array('Submission', 'Category', 'Role', 'Metareview');
  public $hasOne = array('ReviewForm');

  // validation rules
  public $validate = array(
    'slug' => array(
      'rule' => 'isUnique',
      'required' => 'true',
      'message' => 'This URL slug is already in use.'
    )
  );

  // virtual fields!
  public $virtualFields = array(
    'name' => 'CONCAT(Collection.title, ": ", Collection.subtitle)'
  );

  /* public function afterSave($created) { */
  /*   if(!$created) */
  /*     return true; */

  /*   // create the slug */
  /*   $id = $this->data['Collection']['id']; */
  /*   $title = $this->data['Collection']['title']; */
  /*   $title = strtolower(trim($title)); */
  /*   $slug = str_replace(' ', '_', $title); */
  /*   $slug = preg_replace('/\W+/', '', $slug); */
  /*   $slug = str_replace('_', '-', $slug); */
  /*   $slug = sprintf('%d-%s', $id, $slug); */
  /*   $this->data['Collection']['slug'] = $slug; */
  /*   return $this->save($this->data); */
  /* } */
}
?>