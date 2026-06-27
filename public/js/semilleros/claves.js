//Se agrego un pequeño scrip en "index.html" para que un usuario comun no pudiese cambiar el type por texto y observar la contraseña
document.addEventListener("DOMContentLoaded", function () {
  const input = document.getElementById("password");

  const observer = new MutationObserver(() => {
    if (input.type !== "password") {
      console.warn("¡Tipo de input modificado!");
      input.type = "password";
    }
  });

  observer.observe(input, { attributes: true, attributeFilter: ["type"] });
});
