class StaticPagesController < ApplicationController
  skip_before_action :require_login

  def home; end

  def privacy; end

  def terms; end

  def explanation; end
end
