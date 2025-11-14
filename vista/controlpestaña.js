// 🚫 Bloqueo de múltiples pestañas abiertas con la misma sesión
/*const sessionKey = 'transporte_sesion_abierta';

// Si ya existe una pestaña activa, bloqueamos esta
if (localStorage.getItem(sessionKey)) {
  alert('⚠️ Ya tenés una pestaña abierta con la sesión activa.\nCerrá la otra antes de continuar.');
  // Redirigir al inicio o página de login
  window.location.href = 'index.php?path=inicio';
} else {
  // Registrar que esta pestaña está activa
  localStorage.setItem(sessionKey, 'true');

  // Cuando la pestaña se cierre o recargue, eliminamos la marca
  window.addEventListener('beforeunload', () => {
    localStorage.removeItem(sessionKey);
  });
}
*/