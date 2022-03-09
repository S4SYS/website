class Status extends Lista {
    
    $content;

    init($content) 
    {
        this.cardTitle       = 'Lista de Status';
        this.tableHeadTitles = this.getTitles();
        this.actionName      = 'get_status';
        this.requestBody     = this.getRequestBody();
        this.$content        = $content;
        this.setContent();
     
        $('#add').click(function(){
            alert(this.dataset.hash);
        });        
    }

    getRequestBody() 
    {
        return row => {
            return `<tr>
                    <td>${row.id}</td>
                    <td>${row.nome}</td>
                    <td>${row.created_at}</td>
                    <td>${row.updated_at}</td>
                    <td>
                    <button data-hash="${window.location.hash}" data-id="${row.id}" class="edit d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                    Editar
                    </button>
                    <button data-hash="${window.location.hash}" data-id="${row.id}" class="deactivate d-sm-inline-block btn btn-sm btn-danger shadow-sm">
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
    
}
