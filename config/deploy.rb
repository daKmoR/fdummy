set :repository,  "git@git.webteam.at:webteam-interne-projekte/fdummy.git"

if ENV['DEPLOY'] == 'PRODUCTION'                                         
   puts "*** Deploying to the \033[1;41m  PRODUCTION  \033[0m servers!"
   set  :branch,    "master" # usually master
   set  :deploy_to, "/home/fdummy"
   role :web,       "fdummy.clients.webteam.at"
   set  :user,      "fdummy"
elsif ENV['DEPLOY'] == 'STAGING'
   puts "*** Deploying to the \033[1;42m  STAGING  \033[0m server!"
   set  :branch,    "dev" # usually staging
   set  :deploy_to, "/path/to/use"
   role :web,       "tmp.com"
   set  :user,      "tmp"
else
  user_message('Usage', "\033[1;44m")
              puts
              puts "Usage: "
              puts " ENV['DEPLOY'] == $ENVIROMENT cap deploy"
              puts
              puts "$ENVIROMENT == PRODUCTION | TESTING | STAGING"
end


set :application, "WEBTEAM Deploy"

set :scm, :git

set :deploy_via, :rsync_with_remote_cache
set :use_sudo, false

set :keep_releases, 3
after "deploy:update", "deploy:cleanup"

namespace :deploy do
  task :finalize_update, :except => { :no_release => true } do
    run <<-CMD
      rm -rf #{latest_release}/.git/
    CMD
    # run shell cmds like linking shared directories
    # link typo3 back
    run <<-CMD
			ln -s #{shared_path}/typo3 #{latest_release}/typo3
    CMD
  end
end