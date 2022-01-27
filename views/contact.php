<?php 
/** @var $this \kb\phpmvc\View */
/** @var $model \app\models\ContactForm */

use kb\phpmvc\form\TextareaField;

$this->title = 'Contact';
?>

<h1>Contact</h1>

<?php $form = \kb\phpmvc\form\Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php \kb\phpmvc\form\Form::end(); ?>