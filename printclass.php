<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if(!is_dir("C:/school_results/")){
mkdir("C:/school_results/",0777);
}
?>
Choose Class:
<form name="printselect" action='pp.php' method="post">
<select name="select-class">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
  <option selected="selected">
            </option>
</select>
<select name="select-term">
  <option value="first" selected="selected">First Term</option>
  <option value="second">Second Term</option>
  <option value="third">Third Term</option>
</select>
<input type="submit" name="submit" value="Print" />
</form>

</body>
</html>