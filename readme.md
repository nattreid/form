# Rozšířený formulář pro Nette Framework
Podpora překladů

Nastavení v **config.neon**
```neon
extensions:
    - Kdyby\Replicator\DI\ReplicatorExtension

services:
    - 
        implement: NAttreid\Form\IFormFactory
        arguments: [%maxUploadImageSize%]

latte:
    macros:
        - Nextras\Forms\Bridges\Latte\Macros\BS3InputMacros
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