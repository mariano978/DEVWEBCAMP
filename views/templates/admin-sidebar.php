<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?php echo pagina_actual('/dashboard') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid dashboard__icono fa-house"></i>
            <span class="dashboard__menu-texto">Inicio</span>
        </a>
        <a href="/admin/ponentes" class="dashboard__enlace  <?php echo pagina_actual('/ponentes') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid dashboard__icono fa-microphone"></i>
            <span class="dashboard__menu-texto">Ponentes</span>
        </a>
        <a href="/admin/eventos" class="dashboard__enlace  <?php echo pagina_actual('/eventos') ? 'dashboard__enlace--actual' : ''; ?>">
            <i class="fa-solid dashboard__icono fa-calendar"></i>
            <span class="dashboard__menu-texto">Eventos</span>
        </a>
        <a href="/admin/registrados" class="dashboard__enlace  <?php echo pagina_actual('/registrados') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid dashboard__icono fa-user"></i>
            <span class="dashboard__menu-texto">Registrados</span>
        </a>
        <a href="/admin/regalos" class="dashboard__enlace  <?php echo pagina_actual('/regalos') ? 'dashboard__enlace--actual' : ''; ?>">
        <i class="fa-solid dashboard__icono fa-gift"></i>
            <span class="dashboard__menu-texto">Regalos</span>
        </a>
    </nav>
</aside>