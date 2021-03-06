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
        let reference = window.location.hash.replace('#', '');    
        return row => {
            return `
            <tr>
            <td>${row.id}</td>
            <td>${row.nome}</td>
            <td>${row.created_at}</td>
            <td>${row.updated_at}</td>
            <td>
            ${super.getButtons(row.id, reference)}
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
            `<input type="hidden" name="token" value="${Config.TOKEN}">`,            
            '</div>',
            '</form>'
        ];
    }

    getByCode()
    {
        let self = this;
     
        $.get(Config.API_URL, { 
            id    : this.dataSets.id,
            acao  : 'get_status_by_code',
            token : Config.TOKEN  
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
            `<input type="hidden" name="token" value="${Config.TOKEN}">`,            
            '</div>',
            '</form>'
        ];
    }
    
    
 /*
  * Particularidades da Timeline referente a Status.
  */
   timeline($content, id)
   {
     this.id = id;
   }
}
