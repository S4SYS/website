class Status extends Lista {
    
    $content;
    modal;
    dataSets;


    init($content) 
    {
        this.cardTitle       = 'Lista de Status';
        this.tableHeadTitles = this.getTitles();
        this.actionName      = 'get_status';
        this.requestBody     = this.getRequestBody();
        this.$content        = $content;
        this.setContent();   
    }

    getRequestBody() 
    {      
        return row => {
            return `
            <tr>
            <td>${row.id}</td>
            <td>${row.nome}</td>
            <td>${row.created_at}</td>
            <td>${row.updated_at}</td>
            <td>
            <button data-hash="${window.location.hash}" 
            onClick="Modal.init(this)" 
            data-id="${row.id}" data-action="edit" 
            class="edit d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            Editar
            </button>
            <button data-hash="${window.location.hash}" 
            onClick="Modal.init(this)" 
            data-id="${row.id}" data-action="deactivate" 
            class="deactivate d-sm-inline-block btn btn-sm btn-danger shadow-sm">
            Desativar
            </button>
            </td>
            </tr>`;
        }
    }

    getTitles() 
    {
        return [
            'Id',
            'Nome',
            'Data de cria&ccedil;&atilde;o',
            'Data de atualiza&ccedil;&atilde;o',
            'A&ccedil;&otilde;es'            
        ];
    }
    
    
    /*
    * Particularidades do Modal referentes a Status.
    */
    setModalContentByAction(elem) 
    {
        this.modal = elem;
        this.dataSets = this.modal.$domElement.dataset;

        switch (this.dataSets.action) {
            case ('edit'):
                this.modal.$title.html('Editar Status');
                this.getByCode();
                break;
            case ('add'):
                this.modal.$title.html('Adicionar Status');
                this.modal.$body.html(this.getAddBodyContent().join(''));
                break;
            case ('deactivate'):
                this.modal.$title.html('Desativar Status');
                break;
        }
    }

    getAddBodyContent()
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

    getByCode()
    {
        let self = this;
     
        $.get('../api.php', { 
            id   : this.dataSets.id,
            acao : 'get_status_by_code' 
        }, function(response){
            self.modal.$body.html(self.getEditBodyContent(response.data).join(''));
        }, 'json');
    }

    getEditBodyContent(dados)
    {
        return [
            '<form>',
            '<div class="form-group">',
            '<label for="id">ID</label>',
            `<input type="number" name="id" id="id" class="form-control" readonly value="${dados.id}">`,            
            '<label for="nome">Nome</label>',
            `<input type="text" name="nome" id="nome" class="form-control required" value="${dados.nome}">`,
            '<input type="hidden" name="acao" value="edit_status">',            
            '</div>',
            '</form>'
        ];
    }   
}
