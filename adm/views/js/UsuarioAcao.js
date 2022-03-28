class UsuarioAcao extends Lista
{
    modal;
    dataSets;

    setModalContent(elem)
    {
        this.modal = elem;
        this.dataSets = this.modal.$domElement.dataset;

        this.modal.$title.html('Confirmar Reenvio');
        this.modal.$body.html(this.getBody().join(''));
        this.modal.$footer.find('#btnSalvar').text('Confirmar').attr('data-reference', this.dataSets.reference);
    }

    getBody()
    {
        return [
            'Deseja reenviar o email da &uacute;ltima atualiza&ccedil;&atilde;o para o solicitante?',
            '<form>',
            `<input type="hidden" name="acao" value="${this.dataSets.action}">`,
            `<input type="hidden" name="id" value="${this.dataSets.id}">`,
            `<input type="hidden" name="reference" value="${this.dataSets.reference}">`,
            '</form>'
        ];
    }
}