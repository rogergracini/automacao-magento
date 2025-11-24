# Projeto: Automatização de Transferência FTP (LocalWeb -> HostGator)

Este projeto tem como objetivo automatizar o processo de download de um arquivo `arq.zip` via FTP da **LocalWeb** e, em seguida, fazer o **upload para a HostGator**, utilizando **GitHub Actions**.

---

## ✨ Funcionalidades

- 🔹 Baixa o arquivo `arq.zip` de um servidor FTP da LocalWeb
- 🔹 Envia automaticamente esse arquivo para a pasta `/testeagencia.dev.br/` da HostGator
- 🔹 Execução automática **diariamente às 5h da manhã**
- 🔹 Possibilidade de execução **manual** pela interface do GitHub

---

## 🔄 Automatização via GitHub Actions

Arquivo de workflow: `.github/workflows/baixar-enviar.yml`

### Agendamento:
Executa todos os dias às **5h da manhã (UTC-3 / Horário de Brasília)**
```yaml
schedule:
  - cron: '0 8 * * *'  # UTC = 5h BRT
```

### Secrets obrigatórios:
Vá em **Settings > Secrets and variables > Actions > New repository secret** e adicione:

| Nome        | Descrição                                |
|-------------|------------------------------------------|
| `LWEB_USER` | Usuário FTP da LocalWeb                  |
| `LWEB_PASS` | Senha FTP da LocalWeb                    |
| `HG_USER`   | Usuário FTP da HostGator                 |
| `HG_PASS`   | Senha FTP da HostGator                   |

---

## 📂 Arquivo principal

**`baixar-enviar.php`**
- Localiza-se na raiz do repositório
- Responsável por executar o processo completo de download e upload via `curl`

---

## 🚀 Executar manualmente

No GitHub, acesse a aba **Actions**, escolha o workflow `baixar-enviar`, clique em **Run workflow**, e confirme.

---

## ✅ Exemplo de uso
```bash
php baixar-enviar.php
```

---

## 🌐 Tecnologias utilizadas
- PHP (executado no ambiente do GitHub Runner)
- Curl para download/upload via FTP
- GitHub Actions para automação CI/CD

---

## ✉ Contato
Se tiver dúvidas ou quiser contribuir com melhorias, entre em contato!!!

---

Feito com ❤️ para facilitar processos repetitivos e garantir pontualidade nas importações de arquivos FTP!

