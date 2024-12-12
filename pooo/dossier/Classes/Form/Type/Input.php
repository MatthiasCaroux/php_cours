<?php 
class Input extends GenericFormElement{


    public function render() : string{
        return sprintf(
            '<input type="%s" %s value="%s" name=form[%s] id="%s\"',
            $this->name,
            $this->isRequired() ? 'required="required"' : '',
            $this->getValue(),
            $this->getName(),
            $this->getId()
        );
    }
}
?>