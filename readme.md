# Rozšířený formulář pro Nette Framework
Podpora překladů

Nastavení v **config.neon**
```neon
services:
    - 
        implement: NAttreid\Form\IFormFactory
        arguments: [%maxUploadImageSize%]
```

Použití v presenteru
```php
/** @var \NAttreid\Form\IFormFactory @inject */
public $formFactory;

function createComponentList(){
    $form = $this->formFactory->create();
    // php kod ...
    return $form;
}
```