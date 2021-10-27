class ApplicationController < ActionController::Base
    before_action :require_login
    rescue_from Exception, with: :error500
    rescue_from ActiveRecord::RecordNotFound, ActionController::RoutingError, with: :error404

    def error404(error)
      render file: Rails.root.join('public', '404.html'), status: 404, layout: false, content_type: 'text/html'
    end

    def error500(error)
      logger.error(error.message)
      logger.error(error.backtrace.join("\n"))
      render file: Rails.root.join('public', '500.html'), status: 500, layout: false, content_type: 'text/html'
    end
end
