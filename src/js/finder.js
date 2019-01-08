/**
 * WCMS - WEX Simple CMS
 * https://github.com/vedees/wcms
 * Copyright (C) 2018 Evgenii Vedegis <vedegis@gmail.com>
 * https://github.com/vedees/wcms/blob/master/LICENSE
 */

window.newfolder = function (p) {
  let n=prompt('New folder name','folder')
  if (n!==null && n!=='') {
    window.location.search='p='+encodeURIComponent(p)+'&new='+encodeURIComponent(n)
  }
}

window.rename = function (p,f) {
  let n=prompt('New name',f)
  if (n!==null && n!=='' && n!=f) {
    window.location.search='p='+encodeURIComponent(p)+'&ren='+encodeURIComponent(f)+'&to='+encodeURIComponent(n)
  }
}
window.change_checkboxes = function (l,v) {
  for (let i=l.length-1;i>=0;i--) {
    l[i].checked=(typeof v==='boolean')?v:!l[i].checked;
  }
}
window.get_checkboxes = function () {
  let i = document.getElementsByName('file[]')
      a = []
  for (let j = i.length-1;j>=0;j--) {
    if(i[j].type='checkbox') {
      a.push(i[j])
    }
  }
  return a
}
window.select_all = function () { let l=get_checkboxes();change_checkboxes(l,true)}
window.unselect_all = function (){let l=get_checkboxes();change_checkboxes(l,false)}
window.invert_all = function (){let l=get_checkboxes();change_checkboxes(l)}
window.checkbox_toggle = function (){let l=get_checkboxes();l.push(this);change_checkboxes(l)}