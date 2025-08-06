# 📌 Comandos Úteis

### 🚀 Rodar projetos com WAMP de maneira prática

1. Abra o **Prompt de Comando como Administrador**.
2. Crie um **link simbólico** com o seguinte comando:

```cmd
REM mklink /D "caminho do wamp\nome do link" "caminho do projeto"
mklink /D "H:\wamp64\www\poema-automatico" "C:\meu\projeto\Poema"
```
Obs: ao reiniciar o wamp, terá que recriar o link!
