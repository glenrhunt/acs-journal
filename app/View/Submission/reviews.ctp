<?
$this->start('css');
echo $this->Html->css('edit-review');
$this->end();

$this->start('scripts');
echo $this->Html->script('edit-review');
$this->end();

$save_url = $this->Html->url(array(
  'controller'=>'answers',
  'action'=>'saveJson'
));

	//print_r($submission);
$user_id = $submission['Submission']['user_id'];
$sub_id = $submission['Submission']['id'];
$user_name = $user_list[$user_id];
$authors = array($user_name);

// grab the coauthors
if(isset($coauthors[$sub_id])) {
  foreach($coauthors[$sub_id] as $k=>$v)
    $authors[] = $v;
}

$auth_str = implode(', ', $authors);

$title = $submission['Submission']['title'];
$slug = $submission['Submission']['slug'];
?>

<div class="page-header">
  <? if($admin): ?>
  <ul class="nav nav-pills pull-right">
    <li>
      <a href="<? echo $this->Html->url(array('controller'=>'Collections',
									'action'=>'view', $submission['Collection']['slug'])); ?>">
        <i class="icon-chevron-left" style="margin-right: 10px;"></i>Return to List
      </a>
    </li>
  </ul>
  <? endif; ?>
  <h1><? echo $title; ?></h1>
  <h4 class="authors"><? echo $auth_str; ?></h4>
  
  
  <? if($admin): ?>
	<h3>Metareviewers:</h3>
  <div class="reviewer">
		<? //print_r($reviews); ?>
		<? foreach ($reviews as $review) {	
			if($review['Role']['role_type_id'] != 3)
    		echo $this->Profile->badge($review['User']);
		} ?>
  </div>
	<h3>Reviewers:</h3>
  <div class="reviewer">
		<? foreach ($reviews as $review) {	
			if($review['Role']['role_type_id'] == 3)
    		echo $this->Profile->badge($review['User']);
		} ?>

  </div>
</div>
<? else: ?>
<hr />
<? endif; ?>

<h3>Decision:</h3>
<h4>
<span style="margin-left: 60px;">
<? echo $submission['Category']['name']; ?>
</span>
</h4>
<hr />

<h3>Metareviews</h3>
<div class="question"> 
	<div class="question-text">
    <? foreach ($metareviews as $metareview): ?>
    <div class="answer">
      <h4>
	    <? if($admin): ?>
        <span style="margin-right: 15px;">
          <? 
				$cat = $metareview['Metareview']['category_id'];
				echo ' Recommendation: ';
				$categ = '[Uncategorized or major revisions]';
				// This is really clunky. The 1/2/3/4/5 notation is only there for back compatibility,
				// but even the 51/52/53/54 is annoyingly opaque. - BM Jan 2013
				if(($cat == '51') || ($cat == '1')) $categ = 'Accept as talk';
				if(($cat == '52') || ($cat == '2')) $categ = 'Accept conditionally as talk';
				if(($cat == '53') || ($cat == '3')) $categ = 'Accept as poster';
				if(($cat == '54') || ($cat == '5')) $categ = 'Reject';
				echo $categ;
			?>
         </span>
        <small>
          <? echo $metareview['User']['full_name']; ?>
        </small>
        <? endif; ?>
      </h4>
      <pre style="font-size:11px;padding:7px;line-height:1.4em;margin-top:10px;margin-bottom:20px;"><? echo trim($metareview['Metareview']['content']); ?></pre>
    </div>
    <? endforeach; ?>
    <? if(empty($metareviews)): ?>
    <p class="alert alert-danger">Metareview has not been entered.</p>
    <? endif; ?>
</div>

<hr />

<? $count = 1; ?>
<? foreach($reviews as $i=>$review): ?>
<? if($review['Role']['role_type_id'] == 3): ?>

<h3><span style="margin-right: 15px;">Review <? echo $count; ?></span>
<? $count++; ?>
  <? if($admin): ?>
  <small><? echo $review['User']['full_name']; ?></small>
  <? endif; ?>
</h3>
<? foreach($questions as $question): ?>
<? $question_id = $question['Question']['id']; ?>
<div class="question">
  <div class="order"><? echo $question['Question']['position']; ?></div>
  <div class="question-text">
    <p class="text"><? echo $question['Question']['text']; ?></p>
    <? if(isset($review['Answers'][$question_id])): ?>
    <? $answer = $review['Answers'][$question_id]; ?>
    <div class="answer">
      <h4>
          <? echo $answer['Choice']['text']; ?>
      </h4>
      <pre style="font-size:11px;padding:7px;line-height:1.4em;margin-top:10px;margin-bottom:20px;"><? echo trim($answer['Answer']['comments']); ?></pre>
    </div>
    <? else: ?>
    <div class="alert alert-danger answer">
			The reviewer has not answered this question.
    </div>
    <? endif; ?>
  </div> <!-- end question-text -->
</div>
<? endforeach; ?>
<? endif; ?>
<? endforeach; ?>
</div>
