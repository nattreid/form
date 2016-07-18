# Rozšířený formulář pro Nette Framework
Podpora překladů

Nastavení v **config.neon**
```neon
extensions:
    formExtension: NAttreid\Form\DI\FormExtension
```

možná nastavení
```neon
formExtension:
    maxUploadImageSize: 5 #MB
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