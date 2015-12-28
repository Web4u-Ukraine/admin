<?
session_start();
unset($_SESSION[login_admin]);
unset($_SESSION[access]);
?>
<script>
	window.location.replace('/admin/');
</script>