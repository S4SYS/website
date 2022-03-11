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
        switch (self.$domElement.dataset.hash) {
            case ('#requisicao'):
                this.setRequisicaoContentByAction();
                break;
            case ('#violacao'):
                this.setViolacaoContentByAction();
                break;
            case ('#status'):
                this.setStatusContentByAction();
                break;
            default:
                this.setRequisicaoContentByAction();
                break;    
        }
    }

    static setRequisicaoContentByAction() 
    {
        switch (self.$domElement.dataset.action) {
            case ('edit'):
                self.$title.html('Editar Requisicao');
                break;
            case ('deactivate'):
                self.$title.html('Desativar Requisicao');
                break;
        }
    }

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

    static setStatusContentByAction() 
    {
        switch (self.$domElement.dataset.action) {
            case ('edit'):
                self.$title.html('Editar Status');
                this.getStatusByCode();
                break;
            case ('add'):
                self.$title.html('Adicionar Status');
                self.$body.html(this.getAddStatusBodyContent().join(''));
                break;
            case ('deactivate'):
                self.$title.html('Desativar Status');
                break;
        }
    }

    static getAddStatusBodyContent()
    {
        return [
            '<form>',
            '<div class="form-group">',
            '<label for="id">ID</label>',
            '<input type="number" name="id" id="id" class="form-control required">',            
            '<label for="nome">Nome</label>',
            '<input type="text" name="nome" id="nome" class="form-control required">',
            '<input type="hidden" name="acao" value="add_status">',            
            '</div>',
            '</form>'
        ];
    }

    static getStatusByCode()
    {
        let elem = this;
     
        $.get('../api.php', { 
            id   : self.$domElement.dataset.id,
            acao : 'get_status_by_code' 
        }, function(response){
            self.$body.html(elem.getEditStatusBodyContent(response.data).join(''));
        }, 'json');
    }

    static getEditStatusBodyContent(dados)
    {
        return [
            '<form>',
            '<div class="form-group">',
            '<label for="id">ID</label>',
            `<input type="number" name="id" id="id" class="form-control required" value="${dados.id}">`,            
            '<label for="nome">Nome</label>',
            `<input type="text" name="nome" id="nome" class="form-control required" value="${dados.nome}">`,
            '<input type="hidden" name="acao" value="edit_status">',            
            '</div>',
            '</form>'
        ];
    }
}