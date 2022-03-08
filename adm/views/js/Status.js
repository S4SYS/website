class Status extends Lista {
    
    $content;

    init($content) 
    {
        this.tableHeadTitles = this.getTitles();
        this.actionName      = 'get_status';
        this.requestBody     = this.getRequestBody();
        this.$content        = $content;
        this.setContent();
    }

    getRequestBody() 
    {
        return row => {
            return `<tr>
                    <td>${row.id}</td>
                    <td>${row.nome}</td>
                    <td>${row.created_at}</td>
                    <td>${row.updated_at}</td>
                    </tr>`;
        }
    }

    getTitles() 
    {
        return [
            'Id',
            'Nome',
            'Data de cria&ccedil;&atilde;o',
            'Data de atualiza&ccedil;&atilde;o'            
        ];
    }
}
