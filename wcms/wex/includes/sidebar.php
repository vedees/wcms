<?php
  get_html_name ();
  $select = get_html_select();
?>

<!-- Sidebar Button  -->
<div class="sidebar-open-button"> <div class="button-burger"><span class="line line-1"></span><span class="line line-2"></span><span class="line line-3"></span></div> </div>

<div class="sidebar">
  <div class="container">
    <div class="sidebar-content">
      <p class="ui-text-small" style="margin:16px 0 px 0;"> <?php echo $lang['pages'] ?>:</p>
      <form  id="htmlLinkMenu" method="POST">
        <div class="sidebar-list">
          <?php echo('<select name="pagename">' . $select . '</select>'); ?>
          <button class="button button--round button-primary" type="submit"> Editing </button>
        </div>
      </form>
      <p class="ui-text-small" style="margin:30px 0 6px 0;"> <?php echo $lang['basic'] ?>:</p>
      <ul class="sidebar-list">
        <li class="sidebar-item <?php if(nav_is_active($page, 'dashboard')) echo 'active';?> icon-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
          <a class="sidebar-link" href="index.php"> <?php echo $lang['dashboard'] ?> </a>
        </li>
        <li class="sidebar-item <?php if(nav_is_active($page, 'text')) echo 'active';?> icon-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="10" x2="6" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="18" y1="18" x2="6" y2="18"></line></svg>
          <a class="sidebar-link" href="text.php"> <?php echo $lang['text'] ?> </a>
        </li>
        <li class="sidebar-item <?php if(nav_is_active($page, 'images')) echo 'active';?> icon-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
          <a class="sidebar-link" href="images.php"> <?php echo $lang['images'] ?> </a>
        </li>
        <li class="sidebar-item <?php if(nav_is_active($page, 'css_js_edit')) echo 'active';?> icon-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
          <a class="sidebar-link" href="cssjs.php">CSS & JS</a>
        </li>
        <li class="sidebar-item <?php if(nav_is_active($page, 'html_edit')) echo 'active';?> icon-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>
          <a class="sidebar-link" href="html.php">HTML</a>
        </li>
      </ul>
      <p class="ui-text-small" style="margin:16px 0 6px 0;"> <?php echo $lang['help'] ?>:</p>
      <ul class="sidebar-list">
        <li class="sidebar-item icon-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>  
          <a class="sidebar-link" href="/index.html" target="_blank"> <?php echo $lang['to_site'] ?> </a>
        </li>
        <li class="sidebar-item icon-wrapper">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="4.93" y1="4.93" x2="9.17" y2="9.17"></line><line x1="14.83" y1="14.83" x2="19.07" y2="19.07"></line><line x1="14.83" y1="9.17" x2="19.07" y2="4.93"></line><line x1="14.83" y1="9.17" x2="18.36" y2="5.64"></line><line x1="4.93" y1="19.07" x2="9.17" y2="14.83"></line></svg>
          <a class="sidebar-link" href="docs.php"> <?php echo $lang['docs'] ?> </a>
        </li>
      </ul>
    </div>
  </div>
</div>
