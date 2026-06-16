(function(){
  // Sidebar toggle
  document.querySelectorAll('[data-sidebar-toggle]').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelector('[data-sidebar]').classList.add('open');
      document.querySelector('[data-sidebar-backdrop]').classList.add('open');
    });
  });
  document.querySelectorAll('[data-sidebar-close],[data-sidebar-backdrop]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var s=document.querySelector('[data-sidebar]');
      var b=document.querySelector('[data-sidebar-backdrop]');
      if(s)s.classList.remove('open');
      if(b)b.classList.remove('open');
    });
  });

  // Confirm dialogs
  document.querySelectorAll('[data-confirm]').forEach(function(form){
    form.addEventListener('submit',function(e){
      if(!confirm(form.getAttribute('data-confirm'))){e.preventDefault();}
    });
  });

  // Copy to clipboard
  document.querySelectorAll('[data-copy-target]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var input=document.getElementById(btn.dataset.copyTarget);
      if(!input)return;
      input.select();
      navigator.clipboard&&navigator.clipboard.writeText(input.value);
      btn.textContent='Скопировано';
      setTimeout(function(){btn.textContent='Скопировать';},1500);
    });
  });

  // FAQ accordion (for non-details elements)
  document.querySelectorAll('.faq-question').forEach(function(btn){
    btn.addEventListener('click',function(){
      btn.parentElement.classList.toggle('open');
      var a=btn.nextElementSibling;
      if(a){a.style.display=a.style.display==='block'?'none':'block';}
    });
  });

  // Notifications widget in sidebar (legacy)
  document.querySelectorAll('[data-notifications-toggle]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var list=document.querySelector('[data-notifications-list]');
      if(list)list.classList.toggle('open');
    });
  });

  // Notifications sidebar (bell click) - new slide-out panel
  var notifToggle = document.querySelector('[data-notifications-sidebar-toggle]');
  var notifSidebar = document.querySelector('[data-notifications-sidebar]');
  var notifOverlay = document.querySelector('[data-notifications-sidebar-overlay]');
  var notifClose = document.querySelector('[data-notifications-sidebar-close]');

  function openNotifSidebar(){
    if(notifSidebar) notifSidebar.classList.add('open');
    if(notifOverlay) notifOverlay.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeNotifSidebar(){
    if(notifSidebar) notifSidebar.classList.remove('open');
    if(notifOverlay) notifOverlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  if(notifToggle){
    notifToggle.addEventListener('click', function(e){
      e.preventDefault();
      openNotifSidebar();
    });
  }
  if(notifClose){
    notifClose.addEventListener('click', closeNotifSidebar);
  }
  if(notifOverlay){
    notifOverlay.addEventListener('click', closeNotifSidebar);
  }
  // Close on Escape key
  document.addEventListener('keydown', function(e){
    if(e.key === 'Escape' && notifSidebar && notifSidebar.classList.contains('open')){
      closeNotifSidebar();
    }
  });

  // Modals
  document.querySelectorAll('[data-modal-open]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var d=document.getElementById(btn.dataset.modalOpen);
      if(d&&d.showModal)d.showModal();
    });
  });
  document.querySelectorAll('[data-modal-close]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var d=btn.closest('dialog');
      if(d)d.close();
    });
  });

  // Reveal animation
  var observer='IntersectionObserver' in window?new IntersectionObserver(function(entries){
    entries.forEach(function(entry){
      if(entry.isIntersecting)entry.target.classList.add('visible');
    });
  },{threshold:.12}):null;
  document.querySelectorAll('.reveal').forEach(function(el){
    if(observer)observer.observe(el);else el.classList.add('visible');
  });
})();
