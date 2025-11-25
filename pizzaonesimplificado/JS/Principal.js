const itens = document.querySelectorAll('.pizza')
const popup = document.getElementById('popup')
const btnFechar = document.getElementById('fechar')
const itensCarrinho = document.getElementById('itens')
const totalEl = document.getElementById('total')

    function atualizarCarrinho() {
      let total = 0
      let conteudo = ''
      let temPizza = false

      itens.forEach(pizza => {
        const qtd = parseInt(pizza.querySelector('.qtd').textContent)
        const nome = pizza.dataset.nome
        const preco = parseFloat(pizza.dataset.preco)

        if (qtd > 0) {
          temPizza = true
          const subtotal = preco * qtd
          total += subtotal
          conteudo += `<p>${nome} x${qtd} — R$${subtotal.toFixed(2)}</p>`
        }
      })

      if (temPizza) {
        itensCarrinho.innerHTML = conteudo
        totalEl.textContent = `Total: R$${total.toFixed(2)}`
        popup.classList.add('show')
      } else {
        popup.classList.remove('show')
      }
    }

    itens.forEach(pizza => {
      const menos = pizza.querySelector('.decr')
      const mais = pizza.querySelector('.incr')
      const qtd = pizza.querySelector('.qtd')

      menos.addEventListener('click', () => {
        let valor = parseInt(qtd.textContent)
        if (valor > 0) {
          qtd.textContent = valor - 1
          atualizarCarrinho()
        }
      })

      mais.addEventListener('click', () => {
        let valor = parseInt(qtd.textContent)
        qtd.textContent = valor + 1
        atualizarCarrinho()
      })
    })

    btnFechar.addEventListener('click', () => {
      popup.classList.remove('show')
    })