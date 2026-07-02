<?php
// index.php
require 'conexionbd.php'; // Tu archivo de conexión mysqli

$sql = "SELECT id, nombre, descripcion, imagen, precio, likes, num_descargas FROM modelados";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar sesión · Modelados Infinity</title>
<style>
  :root{
    --bg: #121212;
    --panel: #1b1b1f;
    --panel-border: #2a2a30;
    --text: #f2f2f5;
    --muted: #9a9aa5;
    --accent1: #6a5cff; /* purple from logo */
    --accent2: #00c2ff; /* cyan from logo */
    --accent3: #ff5fa2; /* pink from logo */
    --danger: #ff6b6b;
    --radius: 14px;
  }
  *{box-sizing:border-box;}
  html,body{height:100%;}
  body{
    margin:0;
    font-family: 'Segoe UI', system-ui, -apple-system, Roboto, sans-serif;
    background:
      radial-gradient(circle at 15% 10%, rgba(106,92,255,0.18), transparent 40%),
      radial-gradient(circle at 85% 85%, rgba(0,194,255,0.14), transparent 45%),
      var(--bg);
    color: var(--text);
    display:flex;
    align-items:center;
    justify-content:center;
    padding: 24px;
  }

  .wrap{
    width:100%;
    max-width: 920px;
    display:grid;
    grid-template-columns: 1.1fr 1fr;
    background: var(--panel);
    border: 1px solid var(--panel-border);
    border-radius: var(--radius);
    overflow:hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,0.55);
  }

  /* left brand panel */
  .brand{
    position:relative;
    padding: 48px 40px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    background:
      linear-gradient(160deg, rgba(106,92,255,0.25), rgba(0,194,255,0.10) 50%, transparent 80%),
      #161619;
    border-right:1px solid var(--panel-border);
  }
  .brand-logo{
    display:flex;
    align-items:center;
    gap:12px;
  }
  .rings{
    width:34px;height:34px;flex-shrink:0;
  }
  .brand-name{
    font-size: 20px;
    font-weight: 800;
    letter-spacing: 0.2px;
  }
  .brand-tagline{
    margin-top: 28px;
    max-width: 320px;
  }
  .brand-tagline h2{
    font-size: 28px;
    line-height:1.25;
    margin:0 0 12px;
    font-weight:800;
  }
  .brand-tagline p{
    color: var(--muted);
    font-size: 14.5px;
    line-height:1.6;
    margin:0;
  }
  .preview-cards{
    display:flex;
    gap:10px;
    margin-top:36px;
  }
  .preview-card{
    flex:1;
    height:74px;
    border-radius:10px;
    background: linear-gradient(135deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
    border:1px solid rgba(255,255,255,0.06);
    position:relative;
    overflow:hidden;
  }
  .preview-card::after{
    content:'';
    position:absolute; inset:0;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.05), transparent);
    transform: translateX(-100%);
    animation: shimmer 3.2s ease-in-out infinite;
  }
  .preview-card:nth-child(2)::after{ animation-delay: .4s; }
  .preview-card:nth-child(3)::after{ animation-delay: .8s; }
  @keyframes shimmer{
    0%{transform:translateX(-100%);}
    60%,100%{transform:translateX(100%);}
  }
  .brand-foot{
    color: var(--muted);
    font-size:12.5px;
  }

  /* right form panel */
  .form-side{
    padding: 48px 44px;
    display:flex;
    flex-direction:column;
    justify-content:center;
  }
  .form-side h1{
    margin:0 0 6px;
    font-size: 24px;
    font-weight:800;
  }
  .form-side .sub{
    color: var(--muted);
    font-size: 14px;
    margin:0 0 28px;
  }

  label{
    display:block;
    font-size: 12.5px;
    color: var(--muted);
    margin-bottom: 6px;
    font-weight:600;
    letter-spacing:.2px;
  }
  .field{ margin-bottom: 18px; }
  .input-shell{
    position:relative;
    display:flex;
    align-items:center;
  }
  input[type="text"], input[type="email"], input[type="password"]{
    width:100%;
    padding: 12px 14px;
    background: #101013;
    border: 1px solid #2c2c33;
    border-radius: 10px;
    color: var(--text);
    font-size: 14.5px;
    outline:none;
    transition: border-color .15s ease, box-shadow .15s ease;
  }
  input::placeholder{ color: #5e5e68; }
  input:focus{
    border-color: var(--accent1);
    box-shadow: 0 0 0 3px rgba(106,92,255,0.25);
  }
  .toggle-pass{
    position:absolute;
    right:10px;
    background:none;
    border:none;
    color: var(--muted);
    cursor:pointer;
    font-size: 12.5px;
    padding:4px 6px;
  }
  .toggle-pass:hover{ color: var(--text); }

  .row-between{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin: -4px 0 22px;
    font-size: 13px;
  }
  .remember{
    display:flex;
    align-items:center;
    gap:8px;
    color: var(--muted);
    cursor:pointer;
    user-select:none;
  }
  .remember input{
    width:16px;height:16px;
    accent-color: var(--accent1);
    cursor:pointer;
  }
  .forgot{
    color: var(--accent2);
    text-decoration:none;
  }
  .forgot:hover{ text-decoration:underline; }

  button.submit{
    width:100%;
    padding: 13px;
    border:none;
    border-radius: 10px;
    background: linear-gradient(120deg, var(--accent1), #8b5cff 60%, var(--accent2));
    color:#fff;
    font-size: 15px;
    font-weight:700;
    cursor:pointer;
    letter-spacing:.2px;
    transition: transform .12s ease, filter .12s ease;
  }
  button.submit:hover{ filter: brightness(1.08); }
  button.submit:active{ transform: scale(0.98); }
  button.submit:disabled{
    opacity:.6;
    cursor:not-allowed;
  }

  .error-msg{
    display:none;
    background: rgba(255,107,107,0.1);
    border: 1px solid rgba(255,107,107,0.35);
    color: var(--danger);
    font-size: 13px;
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 18px;
  }
  .error-msg.show{ display:block; }

  .success-msg{
    display:none;
    background: rgba(0,194,255,0.1);
    border: 1px solid rgba(0,194,255,0.35);
    color: var(--accent2);
    font-size: 13px;
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 18px;
  }
  .success-msg.show{ display:block; }

  .divider{
    display:flex;
    align-items:center;
    gap:12px;
    color: var(--muted);
    font-size: 12px;
    margin: 24px 0;
  }
  .divider::before, .divider::after{
    content:'';
    flex:1;
    height:1px;
    background: #2a2a30;
  }

  .footer-link{
    text-align:center;
    font-size: 13.5px;
    color: var(--muted);
  }
  .footer-link a{
    color: var(--accent2);
    text-decoration:none;
    font-weight:600;
  }
  .footer-link a:hover{ text-decoration:underline; }

  .session-note{
    margin-top: 22px;
    font-size: 11.5px;
    color: #6b6b76;
    text-align:center;
    line-height:1.5;
  }

  /* Logged-in panel */
  .logged-panel{
    display:none;
    text-align:center;
  }
  .logged-panel.show{ display:block; }
  .form-side.is-logged .login-form{ display:none; }
  .avatar-big{
    width:64px;height:64px;border-radius:50%;
    background: linear-gradient(135deg, var(--accent1), var(--accent2));
    display:flex;align-items:center;justify-content:center;
    font-weight:800; font-size:22px; margin: 0 auto 14px;
  }
  .logged-panel h2{ margin: 0 0 4px; font-size:20px; }
  .logged-panel p{ color:var(--muted); font-size:13.5px; margin:0 0 22px;}
  .btn-secondary{
    width:100%;
    padding: 12px;
    border-radius:10px;
    border:1px solid #34343c;
    background: transparent;
    color: var(--text);
    font-size: 14px;
    cursor:pointer;
    margin-top:10px;
  }
  .btn-secondary:hover{ background:#202026; }

  @media (max-width: 760px){
    .wrap{ grid-template-columns: 1fr; }
    .brand{ display:none; }
    .form-side{ padding: 36px 26px; }
  }
</style>
</head>
<body>

<div class="wrap">
  <!-- Brand side -->
  <div class="brand">
    <div>
      <div class="brand-logo">
        <svg class="rings" viewBox="0 0 64 32" xmlns="http://www.w3.org/2000/svg">
          <circle cx="16" cy="16" r="13" fill="none" stroke="#6a5cff" stroke-width="5"/>
          <circle cx="32" cy="16" r="13" fill="none" stroke="#00c2ff" stroke-width="5"/>
          <circle cx="48" cy="16" r="13" fill="none" stroke="#ff5fa2" stroke-width="5"/>
        </svg>
        <span class="brand-name">Modelados Infinity</span>
      </div>
      <div class="brand-tagline">
        <h2>Tu galería de modelos 3D, siempre a mano.</h2>
        <p>Inicia sesión para subir modelos, gestionar tus favoritos y seguir tus descargas.</p>
      </div>
      <div class="preview-cards">
        <div class="preview-card"></div>
        <div class="preview-card"></div>
        <div class="preview-card"></div>
      </div>
    </div>
    <div class="brand-foot">© 2026 Modelados Infinity — Modelos · Texturas · Animación</div>
  </div>

  <!-- Form side -->
  <div class="form-side" id="formSide">

    <div class="login-form">
      <h1>Iniciar sesión</h1>
      <p class="sub">Introduce tus datos para acceder a tu cuenta.</p>

      <div class="error-msg" id="errorMsg">Usuario o contraseña incorrectos.</div>
      <div class="success-msg" id="successMsg">Sesión iniciada correctamente. Redirigiendo…</div>

      <form id="loginForm" autocomplete="off">
        <div class="field">
          <label for="username">Usuario o correo electrónico</label>
          <div class="input-shell">
            <input type="text" id="username" placeholder="tu_usuario o correo@ejemplo.com" required>
          </div>
        </div>

        <div class="field">
          <label for="password">Contraseña</label>
          <div class="input-shell">
            <input type="password" id="password" placeholder="••••••••" required>
            <button type="button" class="toggle-pass" id="togglePass">Mostrar</button>
          </div>
        </div>

        <div class="row-between">
          <label class="remember">
            <input type="checkbox" id="remember" checked>
            Mantener sesión iniciada 30 días
          </label>
          <a href="#" class="forgot">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="submit" id="submitBtn">Iniciar sesión</button>
      </form>

      <div class="divider">o</div>
      <p class="footer-link">¿No tienes cuenta? <a href="#">Crea una ahora</a></p>

      <p class="session-note">
        Al iniciar sesión guardamos un identificador en una cookie de este navegador durante 30 días para mantenerte conectado. Puedes cerrar sesión en cualquier momento.
      </p>
    </div>

    <!-- Logged in state -->
    <div class="logged-panel" id="loggedPanel">
      <div class="avatar-big" id="avatarInitial">M</div>
      <h2 id="loggedName">¡Bienvenido de nuevo!</h2>
      <p id="loggedExpiry">Sesión activa</p>
      <button class="submit" id="goHomeBtn" type="button">Ir a Modelados Infinity</button>
      <button class="btn-secondary" id="logoutBtn" type="button">Cerrar sesión</button>
    </div>

  </div>
</div>

<script>
  // ---------- Funciones auxiliares para cookies ----------
  function setCookie(name, value, days) {
    const d = new Date();
    d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + d.toUTCString();
    document.cookie = `${name}=${encodeURIComponent(value)}; ${expires}; path=/; SameSite=Lax`;
  }

  function getCookie(name) {
    const cname = name + "=";
    const parts = document.cookie.split(';');
    for (let part of parts) {
      part = part.trim();
      if (part.indexOf(cname) === 0) {
        return decodeURIComponent(part.substring(cname.length));
      }
    }
    return null;
  }

  function deleteCookie(name) {
    document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; SameSite=Lax`;
  }

  // ---------- Elementos de la interfaz ----------
  const formSide = document.getElementById('formSide');
  const loginForm = document.getElementById('loginForm');
  const loggedPanel = document.getElementById('loggedPanel');
  const errorMsg = document.getElementById('errorMsg');
  const successMsg = document.getElementById('successMsg');
  const submitBtn = document.getElementById('submitBtn');
  const togglePass = document.getElementById('togglePass');
  const passwordInput = document.getElementById('password');

  togglePass.addEventListener('click', () => {
    const isPass = passwordInput.type === 'password';
    passwordInput.type = isPass ? 'text' : 'password';
    togglePass.textContent = isPass ? 'Ocultar' : 'Mostrar';
  });

  function showLoggedInUI(username, expiresDays) {
    formSide.classList.add('is-logged');
    loggedPanel.classList.add('show');
    document.getElementById('avatarInitial').textContent = username.charAt(0).toUpperCase();
    document.getElementById('loggedName').textContent = `¡Hola, ${username}!`;
    document.getElementById('loggedExpiry').textContent =
      `Tu sesión permanecerá activa en este navegador durante ${expiresDays} días.`;
  }

  function showLoginUI() {
    formSide.classList.remove('is-logged');
    loggedPanel.classList.remove('show');
    loginForm.reset();
  }

  // ---------- Al cargar: verificar si existe cookie de sesión ----------
  window.addEventListener('DOMContentLoaded', () => {
    const savedUser = getCookie('mi_session_user');
    if (savedUser) {
      showLoggedInUI(savedUser, 30);
    }
  });

  // ---------- Envío del formulario (autenticación demo) ----------
  loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    errorMsg.classList.remove('show');
    successMsg.classList.remove('show');

    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const remember = document.getElementById('remember').checked;

    if (!username || !password) {
      errorMsg.textContent = 'Por favor, rellena ambos campos.';
      errorMsg.classList.add('show');
      return;
    }

    // Llamada real al endpoint de autenticación del backend
    submitBtn.disabled = true;
    submitBtn.textContent = 'Comprobando…';

    fetch('/api/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        username: username,
        password: password
      })
    })
    .then(response => response.json())
    .then(data => {
      submitBtn.disabled = false;
      submitBtn.textContent = 'Iniciar sesión';

      if (!data.ok) {
        if (data.code === 'USER_NOT_FOUND') {
          errorMsg.textContent = 'El usuario no existe en la base de datos.';
        } else if (data.code === 'INVALID_PASSWORD') {
          errorMsg.textContent = 'Contraseña incorrecta.';
        } else {
          errorMsg.textContent = data.message || 'Error en la autenticación.';
        }
        errorMsg.classList.add('show');
        return;
      }

      successMsg.classList.add('show');

      if (remember) {
        setCookie('mi_session_user', username, 30);
      } else {
        // Cookie solo de sesión (expira cuando se cierra el navegador)
        document.cookie = `mi_session_user=${encodeURIComponent(username)}; path=/; SameSite=Lax`;
      }

      setTimeout(() => {
        showLoggedInUI(username, remember ? 30 : 0);
      }, 700);
    })
    .catch(error => {
      submitBtn.disabled = false;
      submitBtn.textContent = 'Iniciar sesión';
      errorMsg.textContent = 'Error de conexión. Intenta nuevamente.';
      errorMsg.classList.add('show');
      console.error('Error:', error);
    });
  });

  // ---------- Cerrar sesión ----------
  document.getElementById('logoutBtn').addEventListener('click', () => {
    deleteCookie('mi_session_user');
    showLoginUI();
  });

  // ---------- Ir a la página principal (placeholder) ----------
  document.getElementById('goHomeBtn').addEventListener('click', () => {
    alert('Aquí redirigirías a la página principal de Modelados Infinity (por ejemplo: window.location.href = "/").');
  });
</script>

</body>
</html>