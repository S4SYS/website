class Modal 
{
    $modal
    $title;
    $body;
    $footer;
    $domElement;

    static init(elem) 
    {
        self.$modal = $('#actionModal');
        self.$title = self.$modal.find('.modal-header').find('.modal-title');
        self.$body = self.$modal.find('.modal-body');
        self.$footer = self.$modal.find('.modal-footer');
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
                let violacao = new Violacao();
                violacao.setModalContentByAction(self);
                break;
            case ('#status'):
                let status = new Status();
                status.setModalContentByAction(self);
                break;
            case('#usuarioacao'):
                let usuarioAcao = new UsuarioAcao();
                usuarioAcao.setModalContent(self);
                break;    
            default:
                requisicao = new Requisicao();
                requisicao.setModalContentByAction(self);
                break;    
        }
    }  
}