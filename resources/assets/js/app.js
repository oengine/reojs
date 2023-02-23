import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

if (window.ModulePlatform) {
  window.ModulePlatform.on("platform::trigger-component", (el) => {
    if(window.ModulePlatform.$loaded){
        window.livewire?.rescan();
    }
  });
  window.ModulePlatform.on("platform::loaded", (el) => {
    Livewire.hook("message.processed", (message, component) => {
        window.ModulePlatform.dispatch("platform::component",component.el);
      });
  });
  
}
