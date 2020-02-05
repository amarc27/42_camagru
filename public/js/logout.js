function logout()
{
    ajax('../logout.php?action=logout', 'header');
}