class Violacao extends Lista {
    
    $content;

    init($content) 
    {
        this.cardTitle       = 'Lista de Viola&ccedil;&otilde;es';
        this.tableHeadTitles = this.getTitles();
        this.actionName      = 'get_violacoes';
        this.requestBody     = this.getRequestBody();
        this.$content        = $content;
        this.setContent();
    }

    getRequestBody() 
    {
        return row => {
            return `<tr>
                    <td>${row.codigo}</td>
                    <td>${row.cpf}</td>
                    <td>${row.email}</td>
                    <td>${row.nome}</td>
                    <td>${row.telefone}</td>
                    <td>${row.descricao}</td>
                    <td>${row.created_at}</td>
                    <td>
                    <a href="../files/upload/${row.arquivo}" target="_blank">${row.arquivo}</a>
                    </td>
                    <td>${row.nome_status}</td>
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
            'C&oacute;digo',
            'CPF',
            'Email',
            'Nome',
            'Telefone',
            'Viola&ccedil;&atilde;o',
            'Data',
            'Arquivo',
            'Status',
            'A&ccedil;&otilde;es'
        ];
    }

    /*
    * Particularidades do Modal referentes a Requisicao.
    */
    setModalContentByAction(elem) 
    {
        this.modal = elem;
        this.dataSets = this.modal.$domElement.dataset;

        switch (this.dataSets.action) {
            case ('edit'):
                this.modal.$title.html('Editar Viola&ccedil;&atilde;o');
                this.getByCode();
                break;
            case ('deactivate'):
                this.modal.$title.html('Desativar Viola&ccedil;&atilde;o');
                break;
        }
    }
    
    getByCode()
    {
        let self = this;
     
        $.get('../api.php', { 
            id   : this.dataSets.id,
            acao : 'get_status_violacao' 
        }, function(response){
            self.modal.$body.html(self.getEditBodyContent(response).join(''));
        }, 'json');
    }

    getEditBodyContent(dados)
    {
        this.idStatus = dados.current.data.id;

        return [
            '<form>',
            '<div class="form-group">',
            '<label for="status">Status</label>',
            '<select name="id_status" id="id_status" class="form-control required">',
            ...this.getStatusOptions(dados.all.data),
            '</select>',
            '<input type="hidden" name="acao" value="edit_violacao_status">',
            `<input type="hidden" name="id" value="${this.dataSets.id}">`,            
            '</div>',
            '</form>'
        ];
    }

    getStatusOptions(dados)
    {
        let selected;
        return dados.map(row => {
            selected = (row.id === this.idStatus) ? 'selected' : '';
            return `<option value="${row.id}" ${selected}>${row.nome}</option>`;
        });
    }
}
