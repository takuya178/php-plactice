class ApplicationController < ActionController::Base
  add_flash_types :success, :info, :warning, :danger
    # protect_from_forgery with: :exception
    # rescue_from Exception, with: :error_500
    # rescue_from ActionController::RoutingError, with: :error_404
    # rescue_from ActiveRecord::RecordNotFound, with: :error_404

    # def error_500
    #   render file: "#{Rails.root}/public/500.html", layout: false, status: 500
    # end

    # def error_404
    #   render file: "#{Rails.root}/public/404.html", layout: false, status: 404
    # end
end
