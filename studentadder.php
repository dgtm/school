<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<form id="form1" name="form1" method="post" action="adderlogic.php">
  <span id="sprytextfield1">
  <label>name
    <input type="text" name="name" id="name" />
  </label>
  <span class="textfieldRequiredMsg">A value is required.</span></span>
  <p><span id="sprytextfield2">
    <label>class
      <input type="text" name="class" id="class" />
    </label>
    <span class="textfieldRequiredMsg">A value is required.</span></span></p>
  <p><span id="sprytextfield3">
    <label>roll
      <input type="text" name="roll" id="roll" />
    </label>
  <span class="textfieldRequiredMsg">A value is required.</span></span></p>
  <p>
    <label>
      <input type="submit" name="submit" id="submit" value="Submit" />
    </label>
  </p>
</form>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
//-->
</script>

<section id="menu">
<nav>
<ul>
<li><a href="index.php">Home</a></li>
<li><a href="studentadder.php">Add Student</a></li>
<li><a href="list.php">List Students</a></li>
<li>Edit Student Info</li>

</ul>
</nav>
</section>
