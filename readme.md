# Rozšířený formulář pro Nette Framework
Podpora překladů

Nastavení v **config.neon**
```neon
extensions:
    formExt: NAttreid\Form\DI\FormExtension
```

Vypnutí BS3 maker
```neon
formExt:
    BS3Macros: false
```

Použití v presenteru
```php

function createComponentList(){
    $form = new Form;
    // php kod ...
    return $form;
}
```