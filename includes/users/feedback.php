<?php require 'header.in.php'; ?>

<div class="container">
	<div class="notify bg-light">
		<h1>make suggestions</h1>
		<p class="lead">message sent  here  will be fowarded to the management...<i>regards</i></p>
	</div>
	<div class="col-md-10 offset-md-1">
		<form  action="" method="" id="feedback">
		<div><p id="errors"></p></div>
        <div class="form-group border-secondary">
        <label>title</label>
        <input type="text" name="ftitle" class="form-control border-secondary" id="" placeholder="title">
      </div>
      <textarea class="form-control border-secondary" name="ftext"  placeholder="message boddy" rows="6"></textarea>
       <input type="submit" name="" id="feedStory" class="btn btn-success btn-md px-2 m-1 text-center" value="send">
    </form>
	</div>
		
</div>


<?php require 'footer.in.php'; ?>