import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
console.log(window.ModulePlatform);
if (window.ModulePlatform) {
  console.log("reojs");
  window.ModulePlatform.on("platform::trigger-component", (el) => {
    console.log("platform::trigger-component");
    if (window.ModulePlatform.$loaded) {
      window.livewire?.rescan();
    }
  });
  window.ModulePlatform.on("platform::loaded", (el) => {
    Livewire.hook("message.processed", (message, component) => {
      console.log("message.processed");
      window.ModulePlatform.dispatch("platform::component", component.el);
    });
    window.addEventListener("reojs-refresh", ({ detail: option }) => {});
    window.addEventListener("reojs-message", ({ detail: option }) => {
      if (typeof option == "string") {
        window.ModulePlatform.addInfo(option, "reojs-message");
      } else {
        const { error, message, type, meta, ...data } = option;

        window.ModulePlatform.addMessage(
          message ?? error,
          type,
          "reojs-message",
          { ...data, ...meta }
        );
      }
    });
  });
}
