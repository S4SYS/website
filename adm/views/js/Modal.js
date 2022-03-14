class Modal 
{
    $modal
    $title;
    $body;
    $domElement;

    static init(elem) 
    {
        self.$modal = $('#actionModal');
        self.$title = self.$modal.find('.modal-header').find('.modal-title');
        self.$body = self.$modal.find('.modal-body');
        self.$domElement = elem;

        this.startModal();        
        this.setContentByHash();
    }

    static startModal()
    {
        self.$modal.modal('show')
            .find('#btnSalvar')
            .attr('data-hash', self.$domElement.dataset.hash)
            .attr('data-id', self.$domElement.dataset.id)
            .attr('data-action', self.$domElement.dataset.action);
    }

    static setContentByHash() {

        let requisicao;

        switch (self.$domElement.dataset.hash) {
            case ('#requisicao'):
                requisicao = new Requisicao();
                requisicao.setModalContentByAction(self);
                break;
            case ('#violacao'):
                //this.setViolacaoContentByAction();
                break;
            case ('#status'):
                let status = new Status();
                status.setModalContentByAction(self);
                break;
            default:
                requisicao = new Requisicao();
                requisicao.setModalContentByAction(self);
                break;    
        }
    }


    /*    

    static setViolacaoContentByAction() 
    {
        switch (self.$domElement.dataset.action) {
            case ('edit'):
                self.$title.html('Editar Violacao');
                break;
            case ('deactivate'):
                self.$title.html('Desativar Violacao');
                break;
        }
    } 
    */   
}