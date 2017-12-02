<?php namespace Processwire;?>
<div id='body'>
<?php
// LABELS 
$l_name = __('Name');
$l_email = __('Email');
$l_message = __('Message');
$l_yourmessage = __('Your Message');

if($input->post->submit) :

if($session->CSRF->hasValidToken()) {   

$mail = page()->email ? page()->email : 'user@gmail.com';

$m_name = $sanitizer->text($input->post->name);
$m_from = $sanitizer->email($input->post->email);
$m_message = $sanitizer->text($input->post->message);

if($m_name && $m_from  && $m_message) {
    $m_subj = __('Mail Subject');
    $html = "<html><body>
                  <h1>$l_yourmessage</h1>
                  <h3>$l_name: $m_name</h3>
                  <h3>$l_email: $m_from</h3> 
                  <p><b>$l_message:</b> $m_message</p>
             </body></html>"; 

    $m = wireMail();
    // separate method call usage
    $m->to($mail); // specify CSV string or array for multiple addresses
    $m->from($m_from);
    $m->subject($m_subj);
    $m->bodyHTML("$html");
    $m->send();

// If Enable Save Messages    
if(page()->check_1) {
// save to log that can be viewed via the pw backend
  $p = new Page();
  $p->template = 'contact-item';
  $p->parent = 1021;
  $p->title = $m_from . ' - ' . date("Y.m.d | H:i");
  $p->body = $html;
  $p->addStatus(Page::statusHidden); 
  $p->save();
}

} else {
    echo '<h1>' . __('Fill in the field correctly') . '</h1>';
}
?>
<h2><?=$l_yourmessage?></h2>
<h3><?= "$l_name: $m_name"?></h3>
<h4><?= "$l_email:  $m_from"?></h4>
<p><?= "$l_message: $m_message"?></p>

<?php
} else {
    // CSRF NOT FOUND
    echo '<h3>' . __("Something is wrong so try again ") .
         "<a href='./' class='btn btn-lg text-error m-2'>Refresh <i class='icon icon-refresh'></i></a></h3>";
}

// GET DEFAULT FORM
else : 
// GET CSRF PROTECTION
    $tokenName = $this->session->CSRF->getTokenName();
    $tokenValue = $this->session->CSRF->getTokenValue();    
?>

<div class='page-content mt-2'>
  <?=page()->body;?>
</div>

<form action="./" method='post' class="form-horizontal card">

<div class="card-body">

<input type="hidden" id="_post_token" name="<?=$tokenName?>" value="<?=$tokenValue?>">

  <div class="form-group">
    <div class="col-2 hide-sm">
      <label class="form-label" for="input-example-4">
      <i class="fa fa-user-circle" aria-hidden="true"></i> <?=$l_name?>
      </label>
    </div>
    <div class="col-10 col-sm-12">
      <label class="form-label show-sm" for="input-example-4">
        <i class="fa fa-user-circle" aria-hidden="true"></i> <?=$l_name?>
      </label>
      <input name='name' class="form-input" id="input-example-4" placeholder="<?=$l_name?>" autocomplete="off" type="text" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-2 hide-sm">
      <label class="form-label" for="input-example-5">
        <i class="fa fa-envelope-open-o" aria-hidden="true"></i> <?=$l_email?>
      </label>
    </div>
    <div class="col-10 col-sm-12">
    <label class="form-label show-sm" for="input-example-5">
        <i class="fa fa-envelope-open-o" aria-hidden="true"></i> <?=$l_email?>
    </label>
      <input name='email' class="form-input" id="input-example-5" placeholder="<?=$l_email?>" type="email" required>
    </div>
  </div>

  <div class="form-group">
    <div class="col-2 hide-sm">
      <label class="form-label" for="input-example-6">
        <i class="fa fa-question-circle-o" aria-hidden="true"></i> <?=$l_message?>
      </label>
    </div>
    <div class="col-10 col-sm-12">
      <label class="form-label show-sm" for="input-example-6">
        <i class="fa fa-question-circle-o" aria-hidden="true"></i> <?=$l_message?>
      </label>
      <textarea name='message' class="form-input" id="input-example-6" placeholder="<?=$l_message?>" rows="3" required></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-2"></div>
    <div class="col-10">
      <input name='submit' class="btn btn-primary" value='<?=__('Submit');?>' type="submit">
      <button class="btn btn-link" type="reset"><?=__('Cancel')?></button>
    </div>
  </div>

</div><!-- /.card-body -->

</form>

<?php endif;?>

</div>