<?
$this->start('css');
echo $this->Html->css('dashboard');
$this->end();
?>

<div class="page-header">
  <h1>Dashboard</h1>
</div>

<?
echo $this->Html->link(
  'Submit a Paper',
  array('controller'=>'submissions', 'action'=>'create'),
  array('class'=>'btn btn-primary pull-right')
);
?>
<h2>My Submissions</h2>

<p class="alert alert-info">
  <strong>Quick tip:</strong> You can submit a final version of a
  paper by clicking the submission title below, then
  selecting <strong>Actions > Submit Final Version</strong>.
</p>

<table class="table table-condensed">
<?
echo $this->Html->tableHeaders(array(
  '', 'Title', 'Abstract', 'Venue', 'Modified', ''));

foreach($submissions as $submission) {
  $title = $submission['Submission']['title'];
  $id = $submission['Submission']['id'];
  $slug = $submission['Submission']['slug'];

  $title_link = $this->Html->link(
    $title,
    array('controller'=>'submissions', 'action'=>'view', $slug));

  $abstract = $submission['Submission']['abstract'];
  $venue = $submission['Collection']['title'];
  $modified = $submission['Submission']['modified'];
  $modified = $this->Time->timeAgoInWords($modified);
  $locked = null;

  if($submission['Submission']['locked'] == true) {
    $locked = '<i class="icon-lock"></i>';
  }

  $cells = array($locked, $title_link, $abstract, $venue, $modified, null);
  
  echo $this->Html->tableCells($cells, array(), array(), true);
}
?>
</table>
