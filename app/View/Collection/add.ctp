<?
$this->start('scripts');
echo $this->Html->script('add_collection');
$this->end();
?>

<div class="page-header">
  <h1>Create New Collection</h1>
</div>

<?
echo $this->BootstrapForm->create('Collection');
echo $this->BootstrapForm->input('title', array('autofocus'=>true));
echo $this->BootstrapForm->input('subtitle', array('required'=>false));
echo $this->BootstrapForm->input('volume', array(
  'required'=>false, 'label'=>'Volume/Edition'));
echo $this->BootstrapForm->input('slug', array('label'=>'URL Slug'));
echo $this->BootstrapForm->input('description', array(
  'required'=>false));
echo $this->BootstrapForm->input('accepting_submissions', array(
  'required'=>false));
echo $this->BootstrapForm->input('max_submissions_per_reviewer', array(
  'label' => 'Maximum # of review / reviewer'));
echo $this->BootstrapForm->input('min_reviews_per_paper', array(
  'label' => 'Minimum # of reviews / paper'));
echo $this->BootstrapForm->end('Create Collection');
?>