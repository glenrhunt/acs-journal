<div class="page-header">
  <h1>Create Submission</h1>
</div>

<?
echo $this->BootstrapForm->create('Submission');
echo '<div class="control-group">';
echo '<label for="SubmissionCollection" class="control-label">Collection</label>';
echo '<div class="controls">';
printf('<a href="#" id="collection_link" rel="popover" data-content="%s" data-original-title="%s">%s</a>',
  $collection['Collection']['description'], $collection['Collection']['title'],
  $collection['Collection']['title']);
echo '</div>';
echo '</div>';

echo '<div class="control-group">';
echo '<label for="SubmissionPaper" class="control-label">Paper</label>';
echo '<div class="controls">';
printf('<a href="#" id="paper_link" rel="popover" data-content="%s", data-original-title="%s">%s</a>', 
  $paper['Paper']['abstract'], $paper['Paper']['title'], $paper['Paper']['title']);
echo '</div>';
echo '</div>';
echo $this->BootstrapForm->input('presenter_name');
echo $this->BootstrapForm->end('Create Submission');
?>

<? $this->start('scripts'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#collection_link').popover();
    $('#paper_link').popover();
  });
</script>
<? $this->end(); ?>
