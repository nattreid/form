# Rozšířený formulář pro Nette Framework
Podpora překladů

Nastavení v **config.neon**
```neon
services:
    - 
        implement: nattreid\form\IFormFactory
        arguments: [%maxUploadImageSize%]
```

Použití v presenteru
```php
/** @var \nattreid\form\IFormFactory @inject */
public $formFactory;

function createComponentList(){
    $form = $this->formFactory->create();
    // php kod ...
    return $form;
}
```