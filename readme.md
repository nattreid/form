# Rozsireny formular pro Nette Framework
Podpora překladů

Nastavit
```neon
services:
    - 
        implement: nattreid\form\IFormFactory
        arguments: [%maxUploadImageSize%]
```

```php
/** @var \nattreid\form\IFormFactory @inject */
public $formFactory;

function createComponentList(){
    $form = $this->formFactory->create();
    // php kod ...
    return $form;
}
```