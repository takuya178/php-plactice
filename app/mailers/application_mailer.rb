class ApplicationMailer < ActionMailer::Base
  default from: Rails.application.credentials.gmail[:mail_address]
  layout 'mailer'
end
