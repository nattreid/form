# Rozšířený formulář pro Nette Framework
Podpora překladů

Nastavení v **config.neon**
```neon
extensions:
    formExt: NAttreid\Form\DI\FormExtension
```

Zapnuti BS3 input
```neon
formExt:
    BS3Macros: true
```

Použití v presenteru
```php

function createComponentList(){
    $form = new Form;
    // php kod ...
    return $form;
}
```