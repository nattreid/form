# Rozšířený formulář pro Nette Framework
Podpora překladů

Nastavení v **config.neon**
```neon
extensions:
    - NAttreid\Form\DI\FormExtension
```

Použití v presenteru
```php

function createComponentList(){
    $form = new Form;
    // php kod ...
    return $form;
}
```