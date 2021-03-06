var save_interval = null;

$(function() {
  main();
  
  // TODO: add the notifications when something has been saved, and the text edit event

  function main() {
    // entry point
    events();
  }
  
  function events() {
    // attach event handlers
    $('.answer input.radio').change(function() {
      var id = $(this).data('question');
      var question = $('#question-' + id);
      question.save();
    });
    
    // TODO: add the text edit event here
    $('.question textarea').keyup(function() {
      var notify = new Notifier();
      notify.pending('Saving...');
      var element = $(this);
      clearTimeout(save_interval);
      save_interval = setTimeout(function() {
        var id = element.data('question-id');
        var question = $('#question-' + id);
        question.save();
      }, 500);
    });
  }
});

$.fn.save = function() {
  var id = parseInt($(this).data('id'));
  var choice = parseInt($('input[name="question-' + id + '"]:checked').val());
  var comments = $('textarea[name="question-' + id + '"]').val();
  var url = $('.save-url').val();
  var review_id = parseInt($('.review-id').val());
  var review_form_id = parseInt($('.review-form-id').val());
  var user_id = parseInt($('.user-id').val());

  var data = {
    'Answer': {
      'question_id': id,
      'choice_id': choice,
      'comments': comments,
      'user_id': user_id,
      'review_id': review_id,
      'review_form_id': review_form_id
    }
  };
  
  var notify = new Notifier();
  notify.pending('Saving...');
  
  $.post(url, data, function(response) {
    // do something if it's okay
    if(response.ok) {
      notify.success('Saved!');
    }
  }, 'json');
}
